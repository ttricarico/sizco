<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?=$setting['site_name']?> :: Fatal Error</title>
    <style>

    </style>
  </head>
  <body>
      <div id="frame">
        <header>
          There has been a serious error, and the site can't be loaded.
          <h1><?=$errorName?></h1>
        </header>
        <div id="description">
          <p>If a reason was specified, it will be listed below.</p>
          <p id="reason">
            <?=$errorDescription?>
          </p>
        </div>
      </div>
  </body>
</html>
