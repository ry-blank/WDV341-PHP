<?php
	
	class ProductContainer {
		
		public $productName = "PHP Textbook";	
		public $productPrice = "$129.95";
		public $productPageCount = "327";
		public $productISBN = "13-1234435690";

		public function __construct() {
		
		}

			//methods
	
			//setter methods - used to set property values into the object
			//		one method per property
			public function set_productName($inVal){
				$this->productName = $inVal;			//assign input to message
			}
	
			public function set_productPrice($inVal){
				$this->productPrice = $inVal;
			}
	
			public function set_productPageCount($inVal){
				$this->productPageCount = $inVal;
			}
	
			public function set_productISBN($inVal){
				$this->productISBN = $inVal;
			}


			//getter methods - return the property value from the object
			//		one method per property
			public function getProductName(){
				return $this->productName;
			}
		
			public function getProductPrice(){
				return $this->productPrice;
			}	
		
			public function getProductPageCount(){
				return $this->productPageCount;
			}
		
			public function getProductISBN(){
				return $this->productISBN;
			}


	}

	$productObj = new ProductContainer();
	$productObj->set_productName("PHP Textbook");
	$productObj->set_productPrice("$129.95");
	$productObj->set_productPageCount("327");
	$productObj->set_productISBN("13-1234435690");
	

	$returnObj = json_encode($productObj);	//create the JSON object

	echo $returnObj;						//send results back to calling program
	
?>