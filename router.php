<?php
class Router
{
  public function __construct( $root ){
    $this->root = $root;
    $this->routes = array();
    $this->default = array();
  }

  public function addRoute( $route, $result ){
    $this->routes[ $route ] = $result;
  }

  public function addDefault( $result ){
    $this->default["default"] = $result;
  }

  public function getCurrentUri(){
    $req = new stdClass;
    $uri = $_SERVER['REQUEST_URI'];
    return strval($uri);
  }

  public function checkRoutes(){
    $uri = $this->getCurrentUri();
    if( $uri === "/" || $uri === "/index.php" ){
      $this->default["default"]();
    }
    $data = $this->getData();
    foreach ( $this->routes as $route => $result ) {
      if( $route === $uri ){
        if( $data ){
          return $result( $data );
        }else{
          return $result();
        }
      }else{
        $num = $this->hasNum($uri);
        if( $num ){
          $colon = $this->hasColons( $route );
          if( $colon == "/".$num ){
            if( $data ){
              $id = explode( $colon, $uri )[1];
              return $result( $id, $data );
            }else{
              $id = explode( $colon, $uri )[1];
              return $result($id);
            }
          }
        }else{

        }
      }
    }
  }

  public function getData(){
    if( isset( $_POST["data"] ) ){
      $forl = $_POST["data"];
      return $forl;
    }else{
      return false;
    }
  }

  public function hasNum( $string ){
    $array = explode( "/", $string );
    $bool = false;
    $returnArray = array();
    foreach ( $array as $index => $part ) {
      if( (string)(int)$part == $part ){
        $bool = true;
      }else{
        array_push( $returnArray, $part );
      }
    }
    array_push( $returnArray, "/" );
    if( $bool ){
      return join( '', $returnArray );
    }else{
      return false;
    }
  }

  public function hasColons( $string ){
    $array = explode( ":", $string);
    $fin = array();
    foreach( $array as $index => $part ){
      if( sizeof($array) > 1 ){
        if( !($index % 2) ){
          array_push( $fin, $part );
        }
      }else{
        return false;
      }
    }
    return join( '' ,$fin );
  }
}

?>
