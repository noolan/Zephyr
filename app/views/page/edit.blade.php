@extends('layout.bootstrap')

@section('styles')
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<style>
	#editor {overflow:scroll; max-height:300px}
</style>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
		$('#editor').wysiwyg();
	});
</script>
@stop

@section('content')
@parent

<h1>{{ $page->name }}</h1>
<div id="alerts"></div>
<div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="glyphicon glyphicon-font"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
        </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="glyphicon glyphicon-text-height"></i>&nbsp;<b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="glyphicon glyphicon-bold"></i></a>
        <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="glyphicon glyphicon-italic"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="glyphicon glyphicon-list-ul"></i></a>
        <a class="btn btn-info" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="glyphicon glyphicon-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="glyphicon glyphicon-indent-left"></i></a>
        <a class="btn" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="glyphicon glyphicon-indent-right"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn btn-info" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="glyphicon glyphicon-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="glyphicon glyphicon-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="glyphicon glyphicon-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="glyphicon glyphicon-align-justify"></i></a>
      </div>
      <div class="btn-group">
		  <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="glyphicon glyphicon-link"></i></a>
		    <div class="dropdown-menu input-append">
			    <input class="span2" placeholder="URL" type="text" data-edit="createLink">
			    <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="glyphicon glyphicon-cut"></i></a>

      </div>
      
      <div class="btn-group">
        <a class="btn" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="glyphicon glyphicon-picture"></i></a>
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 35px; height: 30px;">
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="glyphicon glyphicon-undo"></i></a>
        <a class="btn" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="glyphicon glyphicon-repeat"></i></a>
      </div>
      <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="" style="position: absolute; top: 280px; left: 1164px;">
    </div>
<div id="editor">{{ $page->content }}</div>
@stop