<?php

class PostVote extends Eloquent {

  protected $table   = 'postvotes';
  public $timestamps = false;

  public function post()
  {
    return $this->belongsTo('Post');
  }

  public function user()
  {
    return $this->belongsTo('User');
  }
}
