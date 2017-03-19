<html>
<head>
<style>
a[target="_blank"]:after {
  content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAQElEQVR42qXKwQkAIAxDUUdxtO6/RBQkQZvSi8I/pL4BoGw/XPkh4XigPmsUgh0626AjRsgxHTkUThsG2T/sIlzdTsp52kSS1wAAAABJRU5ErkJggg==);
  margin: 0 3px 0 5px;
}
</style>
</head>
<body>
<h1>Testing Some Silex Stuff</h1>
<ul>
<li><a href="session/hello/bob" target="_blank">Test Legacy Sessions</a> using
<a href="http://symfony.com/doc/current/components/http_foundation/session_php_bridge.html"
target="_blank">Symfony PhpBridgeSessionStorage</a>. 
</li>
<li>Testing different template loaders
<ul>
<li><a href="templates/file/bob" target="_blank">Load template from a file</a></li>
<li><a href="templates/array/bob" target="_blank">Load template from an array</a></li>
<li><a href="templates/class/bob" target="_blank">Load template from a class</a></li>
</ul>
<li>Show <a href="level1/level2/hello/bob" target="_blank">Show that silex routes are relative</a></li>
</ul>
</body>
