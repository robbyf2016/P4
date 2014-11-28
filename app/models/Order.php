<?php

class Order extends Eloquent {

	public function services() {
        return $this->belongsToMany('Service');
    }

    public function client() {
    	return $this->belongsTo('Client');
    }

}