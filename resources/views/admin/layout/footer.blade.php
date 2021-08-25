<footer class="main-footer">
	<div class="pull-right hidden-xs">
		{{--  <b>Email : </b> candidnepal.itsolutions@gmail.com  --}}
	</div>
	<strong>Copyright &copy; {{ date('Y') }} </strong> All rights reserved.
</footer>

<input type="hidden" name="baseurl" id="baseurl" value="{{ url('/') }}">
<input type="hidden" name="external_filemanager_path" id="external_filemanager_path" value="{{ asset('uploads/filemanager') }}/">
<input type="hidden" name="external_plugins" id="external_plugins" value="{{ asset('uploads/filemanager/plugin.min.js') }}">