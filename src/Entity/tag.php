<?php

namespace App\Entity;

class Tag{

/**
* @var int
*/
 private $id;
/**
* @var string
*/
 private $name;
/**
* @var array
*/
private $articles;





 /**
  * Get the value of id
  *
  * @return  int
  */ 
 public function getId()
 {
  return $this->id;
 }

 /**
  * Set the value of id
  *
  * @param  int  $id
  *
  * @return  self
  */ 
 public function setId(int $id)
 {
  $this->id = $id;

  return $this;
 }

 /**
  * Get the value of name
  *
  * @return  string
  */ 
 public function getName()
 {
  return $this->name;
 }

 /**
  * Set the value of name
  *
  * @param  string  $name
  *
  * @return  self
  */ 
 public function setName(string $name)
 {
  $this->name = $name;

  return $this;
 }


/**
 * Get the value of articles
 *
 * @return  array
 */ 
public function getArticles()
{
return $this->articles;
}

/**
 * Set the value of articles
 *
 * @param  array  $articles
 *
 * @return  self
 */ 
public function setArticles(array $articles)
{
$this->articles = $articles;

return $this;
}
}
