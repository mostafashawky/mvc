<?php

namespace MVC\LIB;

// Interface Responsible For Validate Inputs In Controller  
trait validate   
{
   // Trait Method Used For Inhertance Because PHP Support Single Inhertance
   private $_pattern = [
        "alpha"        => "/^[A-Za-z\p{Arabic}]+$/u",
        "alphaNumeric" => '/^(?:[A-Za-z]+\d+|\d+[A-Za-z]+)$/',
        'number'       => "/^[1-9]+$/",
        'float'        => "/^\d+\.\d+$/", // Dot Character (WildCard) Indicate To Any Character Whether Word Character Or Digit Or Symbol    
        "url"          => "/^(?:https?:\/\/)?(?:[a-z1-9]{2,}.)?[a-z]+\.[a-z]{2,}$/",
        "email"        => "/^[A-Za-z-_%^\d]+@[A-Za-z]+\.\w{2,4}$/",
        
    ];  
  
   public function req( $input ) 
   {
        return "" != $input || !empty($input);
   } 

   public function confirm( $input, $otherField )
   {
        return $input === $otherField;
   }

   public function eq( $input, $against )
   {
        return  $input ===  $against;
   }

   private function alpha( $input )
   {
       return (boolean)  preg_match( $this->_pattern['alpha'], $input );
   }

   private function alphaNumeric( $input )
   {
       return (boolean) preg_match( $this->_pattern['alphaNumeric'], $input );
   }

   private function number( $input ) 
   {
       return (boolean) preg_match( $this->_pattern['number'], $input );
   } 

   private function float( $input )
   {
       return (boolean) preg_match( $this->_pattern['float'], $input );
   }
   
   private function floatLike( $input, $beforeDC, $afterDec )
   {
       // Check First If The Input That User Enter Is Float
       if( $this->float( $input )  ){
            var_dump($beforeDC, $afterDec);
            return (boolean) preg_match( "/^\d{".$beforeDC."}\.\d{".$afterDec."}$/", $input );
       }
   }

   private function url( $input )
   {
       return (boolean) preg_match( $this->_pattern['url'], $input );
   }

   private function email( $input )
   {
       return (boolean) preg_match( $this->_pattern['email'], $input );
   }

   private function lt( $input, $against )
   {
       
        return mb_strlen( $input ) <= $against;
       
   }
  
   private function gt( $input, $against )
   {
    
      return mb_strlen( $input ) >= $against;
       
   } 

   public function isValid( $inputValidation, $postArray )
   {
       // Error Variable Contain The Error The This Method Get
       $errors = [];

       // Status Of Error Fields
       $status = [];
        // Loop Through InputValidation 
        foreach( $inputValidation as $fieldname => $validationType ){

           // Convert ValdationType To Array With PipeLine 
           $validationType = explode( "|", $validationType );

           // Loop Throuh Validation Type Array
           foreach( $validationType as $validation ){
               // Check If The Error Status Filled With This Field
               if( array_key_exists( $fieldname , $status ) ) {
                    continue; // Start Loop With Next Value
               }
               // Check If The Method Contain Specific Paramter Like gt
               if( preg_match_all( "/(?:(?:lt|gt)|\d{1,2})/", $validation, $matches ) ) {
                    // Loop Through The Matched Regexp
                    foreach( $matches as $match ) {
                        $methodName = $match[0];
                        $against    = $match[1];

                        // Run Validation Method That Contain Params
                        // Check If The Returned Value Equal False
                        if( $this->$methodName( $postArray[ $fieldname ], $against ) === false) {
                            $status[ $fieldname ] = true; 

                            $errors[] = $this->language->replaceWildcard( "error_".$methodName, [ $this->language->getKey("form_label_".$fieldname.""), $against] );
 
                        }
                    }
                         
               } elseif( preg_match_all("/(?:confirm|re\w{3,})/",$validation, $matches) ) {
                        
                        // Validation Confirm Inputs
                        foreach( $matches as $match ){
                            $methodName = $match[0];
                            $against    = $match[1];
                            if( $this->$methodName( $postArray[ $fieldname ], $postArray[ $against ] ) == false ){
                                $status[$fieldname] = true;
                                $errors[] = $this->language->replaceWildcard("error_".$methodName, [ $this->language->getKey("form_label_".$fieldname."") ] ); 
                            }
                        }
                        
               } else {

                   if( $this->$validation( $postArray[ $fieldname ] ) === false ){
                         $status[$fieldname] = true;
                         if( $validation == "req"){
                            $errors[] = $this->language->replaceWildcard("error_".$validation, [$this->language->getKey("form_label_".$fieldname."")]);
                         } else if( $validation == "email" ){
                             $errors[] = $this->language->replaceWildcard("error_".$validation, [$this->language->getKey("form_label_".$fieldname."")]);
                         }
                   }    
               }
           } 
          
        }
        if( !empty( $errors) ){
            foreach(  $errors as $error){
                // Set Message Moduel With Errors To Print It In Add User Page
                 $this->messenger->setMessage($error, 3) ;  
            }
            
            return false;
        }
        return true;
   }
}
 