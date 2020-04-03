<style type="text/css">
	.searchbox input{
		height: 30px;
		padding: 6px 12px;
		font-size:14px;
		line-height:1.42857143;
		color:#555;
		background-color:#fff;
		background-image:none;
		border:1px solid #ccc;
		border-radius:4px;
		-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow:inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
	.searchbox button{
		margin: 0px;
		margin-left: -5px;
		margin-top: -2px;
		height: 30px;
		width: auto;
	}

	.searchbox{
		margin-top: 10px;
		margin-left: 10px;
		float: right;
		overflow: auto;
	}
</style>


<div class="searchbox" id="searchdiv">
    <form action="" class="input-group form" method="get">
      <input type="text" placeholder="Search.." name="query"<?php if(isset($_GET['query'])){?>value=<?php echo($_GET['query']);}?>>
      <button type="submit" name="search" class="input-group-addon"><i class="glyphicon glyphicon-search"></i></button>
    </form>
</div>
