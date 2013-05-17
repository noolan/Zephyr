<?php

class Item extends Eloquent {

	protected $table = 'items';
	protected $guarded = array('id');
	public $timestamps = true;

	private $_currentRevision = null;

	// relations
	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}
	public function collection() {
		return $this->belongsTo('Collection');
	}
	public function category() {
		return $this->belongsTo('Category');
	}

	// accessors
	public function currentRevision() {
		if (is_null($this->_currentRevision))
			$this->_currentRevision = $this->revisions()->collection()->first();
		return $this->_currentRevision;
	}
	public function getNameAttribute() {
		return $this->currentRevision()->name;
	}
	public function getSlugAttribute() {
		return $this->currentRevision()->slug;
	}
	public function getContentAttribute() {
		return $this->currentRevision()->content;
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}


}