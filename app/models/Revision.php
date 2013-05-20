<?php

class Revision extends Eloquent {
	
	protected $table   = 'revisions';
	protected $guarded = array('id');
	public $timestamps = true;

	public function revised() {
		return $this->morphTo();
	}

	public function scopePages($query) {
		return $query->where('revised_type', 'Page')
		             ->where('language_id', Language::current()->id)
		             ->orderBy('created_at', 'DESC');
	}

	public function scopeCategories($query) {
		return $query->where('revised_type', 'Category')
		             ->where('language_id', Language::current()->id)
		             ->orderBy('created_at', 'DESC');
	}

	public function scopeCollections($query) {
		return $query->where('revised_type', 'Collection')
		             ->where('language_id', Language::current()->id)
		             ->orderBy('created_at', 'DESC');
	}

	public function scopeItems($query) {
		return $query->where('revised_type', 'Item')
		             ->where('language_id', Language::current()->id)
		             ->orderBy('created_at', 'DESC');
	}
}