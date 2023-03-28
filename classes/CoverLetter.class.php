<?php
class CoverLetter {
  private $selected_category;
  private $selected_template;
  private $name;
  private $position;
  private $company;

  public function __construct() {
    $this->selected_category = '';
    $this->selected_template = '';
    $this->name = '';
    $this->position = '';
    $this->company = '';
  }

  public function setSelectedCategory($category) {
    $this->selected_category = $category;
  }

  public function setSelectedTemplate($template) {
    $this->selected_template = $template;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setPosition($position) {
    $this->position = $position;
  }

  public function setCompany($company) {
    $this->company = $company;
  }

  public function generate() {
    $template_file = "templates/" . strtolower(str_replace(' ', '-', $this->selected_category)) . "/" . str_replace(' ', '-', strtolower($this->selected_template)) . ".txt";
    $template_content = file_get_contents($template_file);

    $letter_content = str_replace("[Name]", $this->name, $template_content);
    $letter_content = str_replace("[Position]", $this->position, $letter_content);
    $letter_content = str_replace("[Company]", $this->company, $letter_content);

    return $letter_content;
  }

  public function getTemplateCategories() {
    $categories = array();
  
    // Get all directories in the templates directory
    $dirs = array_filter(glob('templates/*'), 'is_dir');
  
    // Extract category names from the directory names
    foreach ($dirs as $dir) {
      // Get the directory name and remove the "templates/" prefix
      $dir_name = substr($dir, strlen('templates/'));
      
      // Convert hyphens to spaces and split the words
      $words = explode('-', $dir_name);
      
      // Convert the first letter of each word to uppercase
      foreach ($words as &$word) {
        $word = ucfirst($word);
      }
      
      // Join the words with spaces and add the category name to the array
      $categories[] = implode(' ', $words);
    }
  //var_dump($dirs);
    return $categories;
}

  

  
  public function getSelectedCategory() {
    return $this->selected_category;
  }

  public function getSelectedTemplate() {
    return $this->selected_template;
  }

  public function getTemplates($category) {
    $category_folder = strtolower(str_replace(' ', '-', $category));
    $templates_dir = "templates/" . $category_folder;
  
    if (is_dir($templates_dir)) {
      $templates = scandir($templates_dir);
      $templates = array_filter($templates, function($item) {
        return $item != '.' && $item != '..';
      });
      return $templates;
    } else {
      return array();
    }
  }
}
