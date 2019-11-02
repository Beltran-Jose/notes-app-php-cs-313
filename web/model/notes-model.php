<?php

function addNote($user_id, $notes_text) {
  $db = connect_db();
  $sql = 'INSERT INTO notes (user_id, notes_text) VALUES (:user_id, :notes_text)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->bindValue(':notes_text', $notes_text, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function updateNote($id, $notes_text) {
  $db = connect_db();
  $sql = 'UPDATE notes SET notes_text = :notes_text WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':notes_text', $notes_text, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function deleteNote($id) {
  $db = connect_db();
  $sql = 'DELETE FROM notes WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getNotes($user_id) {
  $db = connect_db();
  $sql = 'SELECT * FROM notes WHERE user_id = :user_id ORDER BY date DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $reviews;
}


?>
