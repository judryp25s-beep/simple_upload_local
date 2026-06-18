<?php

function connect() {
    static $con = null;
    //connexion existante
    if ($con !== null) return $con;
    $con = mysqli_connect(
        "localhost",
        "root",
        "",
        "upload_files"
    );
    //erreur de connexion
    if (!$con) die("Erreur de connexion à la base de données : ". mysqli_connect_error());

    mysqli_set_charset($con, 'utf8mb4');
    return $con;
}

function upload_files($file, $upload_dir, $allowed_types, $max_size = 20) {
    $max_size *= 1024*1024;

    if ($file == null || empty($upload_dir)) { return; }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }

    if ($file['size'] > $max_size) {
        die('Erreur : Fichier trop volumieux, votre fichier fait '. ($file['size']/(1024*1024)). " Mo.");
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($allowed_types != null && !in_array($mime, $allowed_types) ) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;
    // Déplace le fichier
    if (move_uploaded_file($file['tmp_name'], $upload_dir . $newName)) {
        echo "Fichier uploadé avec succès : ". $newName;
        return true;
    } else {
        echo "Échec du déplacement du fichier.";
    }
}

function ajouter_ligne_table($table, $ligne) {
    $sql = 'INSERT INTO %s ';
    $sql = sprintf($sql, $table);
    $i = 0;
    foreach ($ligne as $col => $val) {
        $sql .= '%s';
        $sql = sprintf($sql, $col);
        $i++;
        if ($i != count($ligne))
            $sql .= ', ';
    }

    $sql .= ' VALUES (';

    $i = 0;
    foreach ($ligne as $col => $val) {
        $sql .= '"%s"';
        $sql = sprintf($sql, $val);
        $i++;
        if ($i != count($ligne))
            $sql .= ', ';
    }
    $sql .= ');';
    echo $sql;
}

function ajouter_lignes_table($table, $lignes) {
    $sql = 'INSERT INTO %s ';
    $sql = sprintf($sql, $table);
    $i = 0;
    foreach ($lignes[0] as $col => $val) {
        $sql .= '%s';
        $sql = sprintf($sql, $col);
        $i++;
        if ($i != count($lignes[0]))
            $sql .= ', ';
    }

    $sql .= ' VALUES ';

    foreach ($lignes as $j => $ligne) {
        $sql .= '(';
        $i = 0;
        foreach ($ligne as $col => $val) {
            $sql .= '"%s"';
            $sql = sprintf($sql, $val);
            $i++;
            if ($i != count($ligne))
                $sql .= ', ';
        }
        $sql .= ')';
        if ($j < count($lignes) - 1)
            $sql .= ", ";
    }
    $sql .= ";";
    echo $sql;
}

function demander_ligne($mysqli_result) {
    return mysqli_fetch_assoc($mysqli_result);
}

function demander_lignes($mysqli_result) {
    $tab = [];
    while ($ligne = mysqli_fetch_assoc($mysqli_result)) {
        $tab[] = $ligne;
    }
    return $tab;
}

function faire_requete($sql) {
    mysqli_query(connect(), $sql);
}