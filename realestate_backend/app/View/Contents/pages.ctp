<header id="head" class="secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1><?php echo h($linkName1);?> <span><?php echo h($linkName2);?></span></h1>
                </div>
            </div>
        </div>
    </header>
    
    <section class="container">
        <div class="row">
            <!-- main content -->
            <section class="col-sm-12 maincontent">
                <p><?php echo str_replace("<script","",$contentPost['Content']['main_content']);?></p>
            </section>
        </div>
    </section>
    
