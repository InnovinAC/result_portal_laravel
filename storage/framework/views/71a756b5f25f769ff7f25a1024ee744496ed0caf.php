<!Doctype HTML>
<html>
    <head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <style>
        @import 'https://fonts.googleapis.com/css?family=VT323';


body,
h1,
h2,
h3,
h4,
p,
a { color: #e0e2f4; }

body,
p { font: normal #{20px}/1.25rem 'VT323', monospace; }
h1 { font: normal 2.75rem/1.05em 'VT323', monospace; }
h2 { font: normal 2.25rem/1.25em 'VT323', monospace; }
h3 { font: lighter 1.5rem/1.25em 'VT323', monospace; }
h4 { font: lighter 1.125rem/1.2222222em 'VT323', monospace; }

body { background: #0414a7; }

.container {
  width: 90%;
  margin: auto;
  max-width: 640px;
}

.bsod {
  padding-top: 10%;

  .neg {
    text-align: center;
    color: #0414a7;

    .bg {
      background: #aaa;
      padding: 0 15px 2px 13px;
    }
  }
  .title { margin-bottom: 50px; }
  .nav {
    margin-top: 35px;
    text-align: center;

    .link {
      text-decoration: none;
      padding: 0 9px 2px 8px;

      &:hover,
      &:focus {
        background: #aaa;
        color: #0414a7;
      }
    }
  }
}

</style>
    </head>
<body>
<main class="bsod container">
    <h1 class="neg title"><span class="bg">Error - <?php echo $__env->yieldContent('code'); ?></span></h1>
    <p><?php echo $__env->yieldContent('text'); ?>.</p>

    <nav class="nav">

      <a onclick="history.back()" href="javascript:void" class="link">Go back</a>&nbsp;|&nbsp;
      <a href="<?php echo e(route('check-result')); ?>" class="link">Home Page</a>
    </nav>
  </main>



</body>
</html>
<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/errors/layout.blade.php ENDPATH**/ ?>