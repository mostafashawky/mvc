<?php
/* 
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: Template
 * Description:
 * Language Module 
 *  --  Responsibe For Handle App Language
 *  --  @param Accept The Controller And Action  To Load The Required Translation File   
 */

 namespace MVC\LIB;

 class Language 
 {
    private $_translation;

    public function loadtranslationFile( $conact )
    {
        $defaultLanguage = DEFAULT_LANGUAGE;
        if( isset($_SESSION['lang']) ) {
            $defaultLanguage = $_SESSION['lang'];
        }   
        // Extract Controller And Action
        $conact = explode( '|', $conact );

        // Get The Translation File Path
        $languagePath = LANGUAGE_PATH . $defaultLanguage . DS . $conact[0] . DS . $conact[1] .'.lang.php';
        // Check If The Translation File Exist
        if( file_exists( $languagePath ) ){
            require_once $languagePath;

            // Check If Array Exist And Not Empty
            if( is_array($_) && ! empty( $_ ) ) {
                foreach( $_ as $title => $value ){
                    $this->_translation[ $title ] = $value;
                }
               
            } else { 
                // If the Array Empty Or Not Exist Then Send Error
                 trigger_error( 'Sorry The Array $_ dosen\'t exists' , E_USER_ERROR); 
              }
        } else {
            //If The File Dosen't Exist Then Send Error
            trigger_error( 'Sorry The File dosen\'t exists' , E_USER_NOTICE) ;
        }
        
    }
    public function getTranslation()
    {
        return $this->_translation;
    }
 }