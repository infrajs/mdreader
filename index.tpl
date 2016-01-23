<html style="background-color:#F2F1bF">
	<head>
		<style>
			code {
				background-color:rgba(255,255,255,0.5);
				padding:1px 5px;
				word-break: normal;
				word-wrap: normal;
				white-space: pre;
				display:inline-block;
			}
		</style>
	</head>
	<body style="margin:50px; font-family:monospace;">
		<div style="float:left; width:25%">
			<h1>Installed</h1>
			{map.vendors::vendor}
		</div>
		<div style="float:right; width:75%;"><div style="margin-left:40px; margin-right:80px">
			<div style="background-color:white; padding:5px; margin-bottom:5px;">
				<div><b>{namedata.vendor}</b> <b style="color:red">{namedata.name}</b> {namedata.list::file}</div>
			</div>
			{src}
			{body}
		</div></div>

	</body>
</html>
{vendor:}<h3>{~key}</h3>
	{::name}
{name:}{is?:aname?:jname}{~last()??:comma}
{aname:}<a href="?src=vendor/{vendor}/{~key}/README.md">{~key}</a>
{jname:}{~key}
{comma:}, 
{point:}.
{file:}<a href="?src={src}">{file}</a>{~last()??:comma}