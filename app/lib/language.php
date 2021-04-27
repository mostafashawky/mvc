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

 use MVC\LIB\SessionManger;

 class Language 
 {
    private $_translation;
    private $_session;

    public function __construct( SessionManger $session ) // @param accept Session Module 
    {
        $this->_session = $session;
    }

    public function loadtranslationFile( $conact ) // @Accept Param Controller And Action
    {
        $defaultLanguage = DEFAULT_LANGUAGE;
        if( isset($this->_session->lang) ) {
            $defaultLanguage = $this->_session->lang;
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
            trigger_error( 'Sorry The File dosen\'t exists' , E_USER_ERROR) ;
        }
        
    }

    public function getTranslation()
    {
        return $this->_translation;
    }

    // This Method Is Responsibe To Get The Translation Key
    public function getKey( $key )
    {
        if( isset( $this->_translation[ $key ]  ) ) {
            return $this->_translation[ $key ];
        } else {
            trigger_error( "Sorry The $key Dosen't Exist", E_USER_ERROR );
        }
    }
    
    // This Method Is Responsibe To Replace The Wild Card With The Appropriate Value
    public function replaceWildcard( $key, $data = [] )
    {
        // Get The Format Of The Errror [error_gt => % must be greatet than % ]
        $key = $this->getKey( $key );
     
        // Array Unshift Push Element In First Data Array
        array_unshift( $data, $key );
        
        // Replace Wild Card
        return call_user_func_array( "sprintf", $data  ) ;
    }
 }