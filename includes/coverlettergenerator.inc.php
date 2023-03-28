<?php

require_once 'classes/CoverLetter.class.php';

// Create a new instance of the CoverLetter class
$generator = new CoverLetter();

// Check which step of the form we're on
if (isset($_POST['step'])) {
  switch ($_POST['step']) {
    case 1:
      // User has selected a template category
      if (isset($_POST['category'])) {
        $category = $_POST['category'];
        $templates = $generator->getTemplates($category);
        $generator->setSelectedCategory($category);
      } else {
        // Category has not been selected, redirect back to step 1
        header("Location: index.php");
        exit;
      }
      ?>
      <div class="form-group">
        <label for="template">Choose a template:</label>
        <select class="form-control" id="template" name="template">
          <?php foreach ($templates as $template): ?>
            <option value="<?php echo $template; ?>"><?php echo ucwords(str_replace('-', ' ', $template)); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Next</button>
      <button type="submit" class="btn btn-secondary" name="prev">Back</button>
      <?php
      break;
     
    case 2:
      // User has selected a template
      if (isset($_POST['template'])) {
        $template = $_POST['template'];
        $generator->setSelectedTemplate($template);
      } else {
        // Template has not been selected, redirect back to step 1
        header("Location: index.php?step=1");
        exit;
      }
      break;

    case 3:
      // User has submitted the form
      if (isset($_POST['name']) && isset($_POST['position']) && isset($_POST['company'])) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $company = $_POST['company'];
        $generator->setName($name);
        $generator->setPosition($position);
        $generator->setCompany($company);
        $result = $generator->generate();
      } else {
        // Required fields have not been filled, redirect back to step 2
        header("Location: index.php?step=2");
        exit;
      }
      break;

      case 'back':
        // User has clicked the back button
        if (isset($_POST['current_step'])) {
          $step = $_POST['current_step'];
          if ($step == 2) {
            $generator->setSelectedTemplate(null);
          }
          if ($step == 1) {
            $generator->setSelectedCategory(null);
          }
        }
        break;
      
      

    default:
      break;
  }
}

// Get the current step
$step = isset($_POST['step']) ? $_POST['step'] : 1;

// Get the template categories
$templateCategories = $generator->getTemplateCategories();
//var_dump($templateCategories);

// Get the selected category and template
$selectedCategory = $generator->getSelectedCategory();
$selectedTemplate = $generator->getSelectedTemplate();


// Get the templates for the selected category
$templates = $generator->getTemplates($selectedCategory);
//var_dump($templates);

