<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Upload</title>
</head>
<body class="d-flex flex-column h-100">
    <header class="bg-dark text-light py-5 px-3">
        <h1>Upload local</h1>
    </header>
    <main class="flex-fill flex-1">
        <section>
            <article>
                <div class="m-3">
                    <form action="traitement.php" method="post" class="form" enctype="multipart/form-data">
                        <div class="m-3">
                            <h1>Upload de fichier</h1>
                            <div class="m-2">
                                <h3>Instructions</h3>
                                <ol>
                                    <li>Lancer, dans serveur php sur la machine, cette page</li>
                                    <li>Connecter les deux appareils au même réseau local</li>
                                    <li>Noter les IP IP_host et IP_visitor</li>
                                    <li>Accéder à cette page avec l'autre appareil non-hôte à l'adresse IP_host/path/to/upload/project</li>
                                </ol>
                            </div>
                        </div>
                        <div class="m-3">
                            <label for="upload">Uploader ici</label>
                            <input type="file" name="upload" id="upload">
                        </div>
                        <div class="m-3">
                            <input type="submit" value="Téléverser" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </main>
    <footer class="bg-dark text-light py-5 px-3">
        <h2>&copy; Copyright</h2>
    </footer>
</body>
</html>