<?php

  require_once("config.php");
  require_once("variables.php");
  require_once("functions.php");
  require_once("factionScores.php");


  if (isset($_GET['id']) && is_numeric($_GET['id']))
  {
    $id = $_GET['id'];

    $query = sprintf("SELECT * FROM pvpstats_battlegrounds WHERE id = %d",
                     $id);

    $result = $db->query($query);

    if (!$result)
      die("Cannot find battleground with id <strong>" . $id . "</strong> in pvpstats_battlegrounds table");

    $row = $result->fetch_array();

    $type = $row['type'];
    $winner_faction = $row['winner_faction'];
    $datetime = $row['date'];
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PvPstats, see who is winning!">
    <meta name="author" content="ShinDarth">

    <title><?= $server_name ?> PvPstats</title>

    <link href="css/bootstrap-cyborg.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="visible-xs navbar-brand" href="#"><?= $server_name ?> PvPstats</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-center">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="main-title"></div>

      <?php if (!isset($id)) { ?>

      <?php } else { ?>

      <table id="bg-table" class="table" data-sortable>
        <thead>
          <tr>
            <th id="character" class="th-elem" onClick="thfocus(this)">Character</th>
            <th id="class" class="th-elem" onClick="thfocus(this)">&#9679;</th>

            <th id="killing-blows" class="th-elem" onClick="thfocus(this)">Killing Blows</th>
            <th id="deaths" class="th-elem" onClick="thfocus(this)">Deaths</th>
            <th id="honorable-kills" class="th-elem" onClick="thfocus(this)">Honorable Kills</th>
            <th id="bonus-honor" class="th-elem" onClick="thfocus(this)">Bonus Honor</th>
            <th id="damage-done" class="th-elem" onClick="thfocus(this)">Damage Done</th>
            <th id="healing" class="th-elem" onClick="thfocus(this)">Healing Done</th>

            <th id="attr1" class="th-elem" onClick="thfocus(this)">Attr1</th>
            <th id="attr2" class="th-elem" onClick="thfocus(this)">Attr2</th>
            <th id="attr3" class="th-elem" onClick="thfocus(this)">Attr3</th>
            <th id="attr4" class="th-elem" onClick="thfocus(this)">Attr4</th>
            <th id="attr5" class="th-elem" onClick="thfocus(this)">Attr5</th>
          </tr>
        </thead>

        <tbody>

          <?php

            $query = sprintf("SELECT * FROM pvpstats_players WHERE battleground_id = %d",
                       $id);

            $result = $db->query($query);

            if (!$result)
              die("Cannot find battleground with id <strong>" . $id . "</strong> in pvpstats_players table.");

            while (($row = $result->fetch_array()) != null)
            {
              printf("<tr>");

              printf("<td>%s</td>", $row['battleground_id']);
              printf("<td>%s</td>", $row['character_guid']);

              printf("<td>%s</td>", $row['score_killing_blows']);
              printf("<td>%s</td>", $row['score_deaths']);
              printf("<td>%s</td>", $row['score_honorable_kills']);
              printf("<td>%s</td>", $row['score_bonus_honor']);
              printf("<td>%s</td>", $row['score_damage_done']);
              printf("<td>%s</td>", $row['score_healing_done']);

              printf("<td>%s</td>", $row['attr_1']);
              printf("<td>%s</td>", $row['attr_2']);
              printf("<td>%s</td>", $row['attr_3']);
              printf("<td>%s</td>", $row['attr_4']);
              printf("<td>%s</td>", $row['attr_5']);

              printf("</tr>");
            }
          ?>

        </tbody>

      </table>

      <?php } ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#killing-blows').click();
    });
    function thfocus(element)
    {
      $('.th-elem').each(function() {
        $( this ).css("color", "#FFF");
      });

      $(element).css("color", "yellow");
    }
    </script>

  </body>
</html>

<?php $db->close(); ?>
