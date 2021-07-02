<?php 
  include_once("./components/head.php");
?>
    <title>Dashboard</title>

  </head>
  <body>
    <?php
      $pageName = "Dashboard";
      include_once("./components/topmenu.php");
      include_once("./components/sidebar.php");
    ?>

    <!-- PAGE CONTENT -->
    <div class="pusher">
      <div class="ui grid container page-content df-jcc p-1r">

        <div class="ui stackable grid row">
          <div class="eight wide column">
            <div class="ui card m-0" style="width: unset">
              <div class="ui comments p-2r">
                <h3 class="ui dividing header">Last Comments</h3>
                <div class="comment">
                  <a class="avatar">
                    <img src="/images/matt.jpg">
                  </a>
                  <div class="content">
                    <a class="author">Matt</a>
                    <div class="metadata">
                      <span class="date">Today at 5:42PM</span>
                    </div>
                    <div class="text">How artistic!</div>
                    <div class="actions">
                      <a class="reply">Reply</a>
                    </div>
                  </div>
                </div>
                <div class="comment">
                  <a class="avatar">
                    <img src="/images/elliot.jpg">
                  </a>
                  <div class="content">
                    <a class="author">Elliot Fu</a>
                    <div class="metadata">
                      <span class="date">Yesterday at 12:30AM</span>
                    </div>
                    <div class="text">
                      <p>This has been very useful for my research. Thanks as well!</p>
                    </div>
                    <div class="actions">
                      <a class="reply">Reply</a>
                    </div>
                  </div>
                  <div class="comments">
                    <div class="comment">
                      <a class="avatar">
                        <img src="/images/jenny.jpg">
                      </a>
                      <div class="content">
                        <a class="author">Jenny Hess</a>
                        <div class="metadata">
                          <span class="date">Just now</span>
                        </div>
                        <div class="text">
                          Elliot you are always so right :)
                        </div>
                        <div class="actions">
                          <a class="reply">Reply</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="comment">
                  <a class="avatar">
                    <img src="/images/joe.jpg">
                  </a>
                  <div class="content">
                    <a class="author">Joe Henderson</a>
                    <div class="metadata">
                      <span class="date">5 days ago</span>
                    </div>
                    <div class="text">
                      Dude, this is awesome. Thanks so much
                    </div>
                    <div class="actions">
                      <a class="reply">Reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="ui message">
              <div class="header">
                New Site Features
              </div>
              <ul class="list">
                <li>You can now have cover images on blog pages</li>
                <li>Drafts will now auto-save while writing</li>
              </ul>
            </div>
            <div class="ui message">
              <div class="header">
                Dummy Content
              </div>
              <ul class="list">
                <li>You can now have cover images on blog pages</li>
                <li>Drafts will now auto-save while writing</li>
              </ul>
            </div>
          </div>

          <div class="eight wide column">
            <div class="ui card m-0" style="width: unset">
              <h1 class="" style="padding-top: 2rem; margin: 0 auto">Site Stats</h1>
              <div class="ui stackable grid statistics m-0a p-2r-0 df-jcc">
                <div class="statistic">
                  <div class="value">22</div>
                  <div class="label">Faves</div>
                </div>
                <div class="statistic">
                  <div class="value">31,200</div>
                  <div class="label">Views</div>
                </div>
                <div class="statistic">
                  <div class="value">22</div>
                  <div class="label">Members</div>
                </div>
              </div>
            </div>
            <div class="ui card mt-2r" style="width: unset">
              <div id="chart2" style="width:100%; height:400px; margin-top: 1rem"></div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="./js/menu.js"></script>
    <?php require_once("./components/charts/pie-options.php") ?>
    <?php require_once("./components/charts/#of-houses-pie.php") ?>
  </body>
</html>