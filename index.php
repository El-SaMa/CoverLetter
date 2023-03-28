<?php

require_once 'classes/CoverLetter.class.php';

// Create a new instance of the CoverLetter class
$generator = new CoverLetter();

// Get the template categories
$templateCategories = $generator->getTemplateCategories();
// var_dump($templateCategories);

// Get the selected category and template
$selectedCategory = $generator->getSelectedCategory();
$selectedTemplate = $generator->getSelectedTemplate();
// var_dump($selectedCategory);
// var_dump($selectedTemplate);

// Get the templates for the selected category
if (!empty($selectedCategory)) {
  $templates = $generator->getTemplates($selectedCategory);
  var_dump($templates);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // User has submitted the form
  if (isset($_POST['category']) && isset($_POST['template']) && isset($_POST['name']) && isset($_POST['position']) && isset($_POST['company'])) {
    $category = $_POST['category'];
    $template = $_POST['template'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $company = $_POST['company'];

    $generator->setSelectedCategory($category);
    $generator->setSelectedTemplate($template);
    $generator->setName($name);
    $generator->setPosition($position);
    $generator->setCompany($company);

    $result = $generator->generate();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cover Letter Generator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.form-group {
			margin-bottom: 1rem;
		}
	</style>
</head>
<body>
	<div class="container my-5">
		<h1>Cover Letter Generator</h1>
    
		<form method="post" action="index.php">

			<div class="form-group">
				<label for="category">Choose a category:</label>
				<select class="form-control" id="category" name="category">
					<?php foreach ($templateCategories as $category): ?>
						<option value="<?php echo $category; ?>"><?php echo ucwords(str_replace('-', ' ', $category)); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="template">Choose a template:</label>
				<select class="form-control" id="template" name="template">
					<?php
                      var_dump($selectedCategory);
                      var_dump($templates);
          foreach ($templates as $template): ?>
						<option value="<?php echo $template; ?>"><?php echo ucwords(str_replace('-', ' ', $template)); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>

			<div class="form-group">
				<label for="position">Position:</label>
				<input type="text" class="form-control" id="position" name="position" required>
			</div>

			<div class="form-group">
				<label for="company">Company:</label>
				<input type="text" class="form-control" id="company" name="company" required>
			</div>

			<button type="submit" class="btn btn-primary">Generate Cover Letter -></button>
		</form>

		<?php if (!empty($result)): ?>
			<div class="mt-5">
				<h2>Generated Cover Letter:</h2>
				<pre><?php echo htmlspecialchars($result); ?></pre>
			</div>
		<?php endif; ?>
	</div>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>