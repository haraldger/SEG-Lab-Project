<?php require_once('../../private/initialise.php');

if (!(am_sysadmin() || am_officer())) {
    redirect_to(url_for('../public'));
}

if (!isset($_GET['id']) || !isset($_GET['round'])) {
    redirect_to(url_for('officer/tournaments.php'));
}

$roundNum = $_GET['round']; 
$tournament = Tournament::find_by_id($_GET['id']);

$organiserIDs = array();
$counter = 0;
foreach ($tournament->get_organisers() as $organiser) {
    $organiserIDs[$counter] = $organiser->id;
    $counter++;
}

if (!in_array(get_session_id(), $organiserIDs)) {
    redirect_to(url_for('officer/tournaments.php?id=' . $id));
}

$match_ids = get_round_matches($tournament->id, $roundNum, $database);

if (is_post_request()) {
    $counter = 1;
    foreach ($match_ids as $match_id) {
        $match = Match::find_by_id($match_id);
        $match->winner = $_POST["matchWinner" . $counter];
        $match->save();
        $counter++;
    }
    redirect_to(url_for('/officer/tournamentMatches.php?id=' . $tournament->id));
}

else {
}

include(SHARED_PATH . '/officer_header.php');
?>

<div class="container mt-5 mb-5">

    <a class="back-link" href="<?php echo url_for('/officer/tournamentMatches.php?id=' . $tournament->id); ?>">&laquo; Back to Matches</a>
    <h1><?php echo h($tournament->name); ?></h1>
    <br>

    <form action="<?php echo url_for('/officer/matchRecord.php?id=' . $tournament->id . '&round=' . $roundNum); ?>" method="post">
        <div class="form-group">
        <?php 
        $counter = 1;
        $form_string = '';
        foreach($match_ids as $match_id) {
            $competitors = get_match_competitors($match_id, $database);
            $form_string .= "<i>Match " . $counter . " Winner:<i><br>";
            $form_string .= '<select name="matchWinner' . $counter . '">';
            $form_string .= '<option value=' . $competitors["compID1"] . '>';
            $form_string .=  $competitors["compEmail1"] . '</option>';
            $form_string .=  '<option value=' . $competitors["compID2"] . '>';
            $form_string .=  $competitors["compEmail2"] . '</option>';
            $form_string .= '</select>';
            $form_string .= "<br><br>";
            $counter++;
        }
        echo $form_string;
        ?>
        </div>
        <div id="operations">
            <input class= "btn btn-primary btn-lg" type="submit" value="Record Matches" />
        </div>
    </form>

</div>


<?php
include(SHARED_PATH . '/footer.php');
?>