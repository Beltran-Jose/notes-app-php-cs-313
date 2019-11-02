<?php

function addNote($user_id, $notes_text) {
  $db = connect_db();
  $sql = 'INSERT INTO notes (user_id, notes_text, dt) VALUES (:user_id, :notes_text)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->bindValue(':notes_text', $notes_text, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function updateNote($user_id, $dt, $notes_text, $reviewId) {
  $db = connect_db();
  $sql = 'UPDATE notes SET user_id = :user_id, dt = :dt, notes_text = :notes_text WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->bindValue(':dt', $dt, PDO::PARAM_INT);
  $stmt->bindValue(':notes_text', $notes_text, PDO::PARAM_INT);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
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

function getNotes($dt) {
  $db = connect_db();
  $sql = 'SELECT * FROM notes WHERE dt = :dt ORDER BY dt DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':dt', $dt, PDO::PARAM_INT);
  $stmt->execute();
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $reviews;
}

function getReview($reviewId) {
  $db = connect_db();
  $sql = 'SELECT * FROM notes WHERE user_id = :user_id ORDER BY dt ASC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $review = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $review;
}

?>
