<?php

class Service extends Eloquent {

	    public function orders() {
        return $this->belongsToMany('Order');
    }

}