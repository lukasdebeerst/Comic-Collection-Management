<?php

class Controller {

  public $route;
  protected $viewVars = array();

  public function filter() {
    setlocale(LC_ALL, 'nl_BE');
    call_user_func(array($this, $this->route['action']));
  }

  public function render() {
    //handle logout
    if(!empty($_POST['action'])){
      if($_POST["action"] === "logout"){
        $_SESSION['currentUser'] = null;
        header('Location: index.php');
      }
    }
    $this->createViewVarWithContent();
    $this->renderInLayout();
  
  }

  public function set($variableName, $value) {
    $this->viewVars[$variableName] = $value;
  }

  private function createViewVarWithContent() {
    extract($this->viewVars, EXTR_OVERWRITE);
    ob_start();
    require __DIR__ . '/../view/' . strtolower($this->route['controller']) . '/' . $this->route['action'] . '.php';
    $content = ob_get_clean();
    $this->set('content', $content);
  }

  private function renderInLayout() {
    extract($this->viewVars, EXTR_OVERWRITE);
    include __DIR__ . '/../view/layout.php';
  }

}
