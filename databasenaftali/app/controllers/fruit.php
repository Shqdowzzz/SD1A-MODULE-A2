
<?php

function veiligTonen($waarde)
{
    return htmlspecialchars((string) $waarde, ENT_QUOTES, 'UTF-8');
}


// FRUIT OVERZICHT
function fruit($conn)
{
    $zoekterm = trim($_GET['find'] ?? '');

    $sql = "SELECT id, name, color, sweetness, herkomst
            FROM fruits
            WHERE name LIKE ?
            ORDER BY name ASC";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die("Fout bij het ophalen van fruit.");
    }

    $zoekwaarde = "%" . $zoekterm . "%";
    mysqli_stmt_bind_param($stmt, "s", $zoekwaarde);
    mysqli_stmt_execute($stmt);

    $resultaat = mysqli_stmt_get_result($stmt);
    $fruits = mysqli_fetch_all($resultaat, MYSQLI_ASSOC);
    $aantal = count($fruits);

    mysqli_stmt_close($stmt);
?>

<section class="page-heading">
    <div>
        <p class="eyebrow">ONTDEK EN BEHEER</p>
        <h1>Fruit overzicht</h1>
        <p class="subtitle">Bekijk alle fruitsoorten en hun eigenschappen.</p>
    </div>
    <a class="button" href="index.php?controller=fruitadd">
        <i class="fa-solid fa-plus"></i> Fruit toevoegen
    </a>
</section>

<section class="toolbar">
    <form class="search-form" method="GET">
        <input type="hidden" name="controller" value="fruit">
        <label class="sr-only" for="fruit-search">Zoek fruit</label>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input id="fruit-search" type="search" name="find"
               placeholder="Zoek op fruitnaam..." value="<?= veiligTonen($zoekterm) ?>">
        <button type="submit">Zoeken</button>
        <?php if ($zoekterm !== '') { ?>
            <a class="clear-search" href="index.php?controller=fruit">Wissen</a>
        <?php } ?>
    </form>
    <span class="result-count"><?= $aantal ?> <?= $aantal === 1 ? 'resultaat' : 'resultaten' ?></span>
</section>

<?php if ($aantal > 0) { ?>
    <section class="fruit-grid">
        <?php foreach ($fruits as $item) { ?>
            <article class="fruit-card">
                <div class="fruit-card-top">
                    <span class="fruit-symbol"><i class="fa-solid fa-leaf"></i></span>
                    <span class="fruit-id">#<?= (int) $item['id'] ?></span>
                </div>

                <h2><?= veiligTonen($item['name']) ?></h2>

                <dl class="fruit-info">
                    <div><dt>Kleur</dt><dd><?= veiligTonen($item['color']) ?></dd></div>
                    <div><dt>Zoetheid</dt><dd><?= veiligTonen($item['sweetness']) ?>/10</dd></div>
                    <div><dt>Herkomst</dt><dd><?= veiligTonen($item['herkomst']) ?></dd></div>
                </dl>

                <div class="card-actions">
                    <a class="button button-secondary"
                       href="index.php?controller=fruitshow&id=<?= (int) $item['id'] ?>">
                        <i class="fa-solid fa-eye"></i> Details
                    </a>

                    <form method="POST" action="index.php?controller=fruitdelete"
                          onsubmit="return confirm('Weet je zeker dat je <?= veiligTonen($item['name']) ?> wilt verwijderen?');">
                        <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                        <button class="button button-danger" type="submit">
                            <i class="fa-solid fa-trash"></i>
                            <span class="sr-only">Verwijderen</span>
                        </button>
                    </form>
                </div>
            </article>
        <?php } ?>
    </section>
<?php } else { ?>
    <section class="empty-state">
        <span class="empty-icon"><i class="fa-solid fa-seedling"></i></span>
        <h2>Geen fruit gevonden</h2>
        <p>Probeer een andere zoekterm of voeg een nieuwe fruitsoort toe.</p>
        <a class="button" href="index.php?controller=fruitadd">
            <i class="fa-solid fa-plus"></i> Fruit toevoegen
        </a>
    </section>
<?php } ?>

<?php
}


// FRUIT DETAILS
function fruitshow($conn)
{
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $geldigeId = ($id !== false && $id !== null && $id > 0);
    $item = null;
    $gevonden = false;

    if ($geldigeId === true) {
        $sql = "SELECT id, name, color, sweetness, herkomst
                FROM fruits
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die("Fout bij het ophalen van fruit.");
        }

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $resultaat = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($resultaat);
        $gevonden = ($item !== null && $item !== false);

        mysqli_stmt_close($stmt);
    }
?>

<a class="back-link" href="index.php?controller=fruit">
    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
</a>

<?php if ($gevonden === true) { ?>
    <section class="detail-card">
        <p class="eyebrow">FRUITDETAILS</p>
        <span class="detail-icon"><i class="fa-solid fa-apple-whole"></i></span>
        <h1><?= veiligTonen($item['name']) ?></h1>
        <p class="subtitle">Alle informatie over deze fruitsoort.</p>

        <dl class="detail-info">
            <div><dt>ID</dt><dd><?= (int) $item['id'] ?></dd></div>
            <div><dt>Kleur</dt><dd><?= veiligTonen($item['color']) ?></dd></div>
            <div><dt>Zoetheid</dt><dd><?= veiligTonen($item['sweetness']) ?>/10</dd></div>
            <div><dt>Herkomst</dt><dd><?= veiligTonen($item['herkomst']) ?></dd></div>
        </dl>

        <a class="button" href="index.php?controller=fruit">Terug naar fruitoverzicht</a>
    </section>
<?php } else { ?>
    <section class="message-card">
        <h1>Fruit niet gevonden</h1>
        <p>Dit fruit bestaat niet of het opgegeven ID is ongeldig.</p>
        <a class="button" href="index.php?controller=fruit">Terug naar overzicht</a>
    </section>
<?php } ?>

<?php
}


// FRUIT TOEVOEGEN
function fruitadd($conn)
{
    $fout = '';

    $name = '';
    $color = '';
    $herkomst = '';
    $sweetness = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $color = trim($_POST['color'] ?? '');
        $herkomst = trim($_POST['herkomst'] ?? '');
        $sweetnessInput = $_POST['sweetness'] ?? '';
        $sweetness = filter_var($sweetnessInput, FILTER_VALIDATE_INT);

        $geldig = (
            $name !== '' &&
            $color !== '' &&
            $herkomst !== '' &&
            $sweetness !== false &&
            $sweetness !== null &&
            $sweetness >= 1 &&
            $sweetness <= 10
        );

        if ($geldig === true) {
            $sql = "INSERT INTO fruits (name, color, sweetness, herkomst)
                    VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt === false) {
                die("Fout bij het toevoegen van fruit.");
            }

            mysqli_stmt_bind_param($stmt, "ssis", $name, $color, $sweetness, $herkomst);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("Location: index.php?controller=fruit&added=1");
            exit;
        } else {
            $fout = "Vul alle velden in. De zoetheid moet een getal van 1 tot en met 10 zijn.";
        }
    }
?>

<a class="back-link" href="index.php?controller=fruit">
    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
</a>

<section class="form-card add-form-card">
    <div class="form-heading">
        <span class="detail-icon"><i class="fa-solid fa-apple-whole"></i></span>
        <p class="eyebrow">FRUITDATABASE</p>
        <h1>Een fruitsoort toevoegen</h1>
        <p class="subtitle">Voeg een nieuwe fruitsoort toe en bewaar de informatie in de database.</p>
    </div>

    <div class="add-info-note">
        <i class="fa-solid fa-circle-info"></i>
        <span>Vul de gegevens zo volledig mogelijk in. Zo kan iedereen de juiste informatie over het fruit terugvinden.</span>
    </div>

    <?php if ($fout !== '') { ?>
        <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> <?= veiligTonen($fout) ?></p>
    <?php } ?>

    <form method="POST" class="fruit-form add-form-grid">
        <div class="form-field">
            <label for="name">Naam van het fruit</label>
            <input type="text" id="name" name="name"
                   placeholder="Bijvoorbeeld: Appel" maxlength="100"
                   value="<?= veiligTonen($name) ?>" required>
        </div>

        <div class="form-field">
            <label for="color">Kleur</label>
            <input type="text" id="color" name="color"
                   placeholder="Bijvoorbeeld: Rood" maxlength="100"
                   value="<?= veiligTonen($color) ?>" required>
        </div>

        <div class="form-field">
            <label for="sweetness">Zoetheid</label>
            <input type="number" id="sweetness" name="sweetness"
                   placeholder="Kies een getal van 1 tot 10"
                   min="1" max="10" step="1"
                   value="<?= veiligTonen($sweetnessInput ?? '') ?>" required>
            <small>1 = niet zoet, 10 = heel zoet.</small>
        </div>

        <div class="form-field">
            <label for="herkomst">Land van herkomst</label>
            <input type="text" id="herkomst" name="herkomst"
                   placeholder="Bijvoorbeeld: Nederland" maxlength="100"
                   value="<?= veiligTonen($herkomst) ?>" required>
        </div>

        <div class="form-buttons">
            <button class="button" type="submit">
                <i class="fa-solid fa-plus"></i> Fruit opslaan
            </button>
            <a class="button button-light" href="index.php?controller=fruit">Annuleren</a>
        </div>
    </form>
</section>

<?php
}


// FRUIT VERWIJDEREN
function fruitdelete($conn)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?controller=fruit");
        exit;
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $geldig = ($id !== false && $id !== null && $id > 0);

    if ($geldig === true) {
        $sql = "DELETE FROM fruits WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die("Fout bij het verwijderen van fruit.");
        }

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: index.php?controller=fruit");
    exit;
}
