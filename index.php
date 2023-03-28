<!DOCTYPE html>
<html>
  <head>
    <title>Cover Letter Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container my-5">
      <h1>Cover Letter Generator</h1>
      <?php require_once 'includes/coverlettergenerator.inc.php'; ?>
      <form method="post">
        <?php if ($step === 1): ?>
          <div class="form-group">
            <label for="category">Choose a category:</label>
            <select class="form-control" id="category" name="category">
              <?php foreach ($templateCategories as $category): ?>
                <option value="<?php echo $category; ?>"><?php echo ucwords(str_replace('-', ' ', $category)); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Next</button>
        <?php elseif ($step === 2): ?>
          <?php var_dump($templates);?>
          <div class="form-group">
            <label for="template">Choose a template:</label>
            <select class="form-control" id="template" name="template">
              <?php foreach ($templates as $template): ?>
                <option value="<?php echo $template; ?>"><?php echo ucwords(str_replace('-', ' ', $template)); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Next</button>
          <button type="submit" class="btn btn-secondary" name="current_step" value="2">Back</button>
        <?php elseif ($step === 3): ?>
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
          <button type="submit" class="btn btn-primary">Generate Cover Letter</button>
          <button type="submit" class="btn btn-secondary" name="current_step" value="3">Back</button>
        <?php endif; ?>
        <input type="hidden" name="step" value="<?php echo $step; ?>">
      </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
