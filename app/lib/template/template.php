<?php

namespace MVC\LIB\template;


class Template
{
    // ActiveFeature Library To Provice The Required Link With Active Class
    use ActiveFeature ;

    private $_actionPath;
    private $_dataModel;
    private $_dataTemplate;
    public function __construct( $holdDataTemplate )
    {
        
        // Template Data
        $this->_dataTemplate = $holdDataTemplate;
    }
    public function setlogicData( $data, $translation )
    {
  
        // Check If There Is Logic Data
        if( $data != null  ) {
            $this->_dataModel = array_merge( $data, $translation );
        } else {
            $this->_dataModel = $translation;
        }

    }
    public function setviewPath( $view )
    {
        $this->_actionPath = $view;
    }
    // Render Start Template 
    private function _startTemplateheader()
    {
        // Check In The Array If The Key Exists
        if( array_key_exists( 'templates_header', $this->_dataTemplate ) ){ 
            @extract( $this->_dataModel );
            include_once $this->_dataTemplate['templates_header']['starttemplateheader'];
        } else {
            trigger_error('Error With Config Template File', E_USER_ERROR);
            exit;
        }
    }

    // Render Css Resources
    private function _headerResources()
    {
        // Check If The CSS Resources Exists
        if( array_key_exists( 'header_resources' , $this->_dataTemplate['templates_header']) ){
           // Loop Through Header Reosources To Generate Css Links
           $links = $this->_dataTemplate['templates_header']['header_resources'];
           foreach( $links as $link ){

               echo "<link rel='stylesheet' href='".$link."' >"; 
           }
           
        } else {
            trigger_error('Error With Config Template File', E_USER_ERROR);
            exit;
        }

    }
    private function _endTemplateheader()
    {
        $endTemplateheader = $this->_dataTemplate['templates_header']['endtemplateheader'];
        require_once $endTemplateheader;
        
    }
    private function _generateBlocks( )
    {
        // Check If The Key Blocks Exists
        if( array_key_exists( 'template_blocks', $this->_dataTemplate) ){
            $templateBlocks = $this->_dataTemplate['template_blocks'];
            // Generate Template Block
            foreach( $templateBlocks as $block => $path ) {
                // Check if The Block Not Equal Action View
                if(  $block != ':action'  ) { 
                    if( file_exists( $path ) ){
                        // Extract The Logic Data 
                        @extract( $this->_dataModel );
                        require_once $path;
                    } else { 
                       exit('Sorry The File dosen\'t exist');  
                     }
                } else {
                    require_once $this->_actionPath;
                }
            }

        }
    }
    private function _loadScripts()
    {
        // Check If The Ket Template Footer exists
        if( array_key_exists( 'templates_footer', $this->_dataTemplate ) ){
            // Generate Scripts
            $scripts = $this->_dataTemplate['templates_footer']['scripts'];
            foreach( $scripts as $script ){
                echo "<script src='".$script."'></script>";
            }
        }
    }
    public function renderApp()
    {
        $this->_startTemplateheader( );
        $this->_headerResources( );
        $this->_endTemplateheader( );
        $this->_generateBlocks( );
        $this->_loadScripts();
    }
    
}

?>