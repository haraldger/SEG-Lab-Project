<?php require_once('../../../private/initialise.php');

if (!(am_sysadmin() || am_officer())) {
    redirect_to(url_for('../../public'));
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('officer/tournaments/tournaments.php'));
}

$tournament = Tournament::find_by_id($_GET['id']);

$organiserIDs = array();
$counter = 0;
foreach ($tournament->get_organisers() as $organiser) {
    $organiserIDs[$counter] = $organiser->id;
    $counter++;
}

if (!in_array(get_session_id(), $organiserIDs)) {
    redirect_to(url_for('officer/tournaments/tournaments.php?id=' . $id));
}

$last_round = find_last_round($tournament->id, $database);
$winner_found = winner_found($tournament->id, $last_round, $database);
$last_round_finished = check_if_round_finished($tournament->id, $last_round, $database);
$can_start = check_competitor_size($tournament->id, $database);

if (is_post_request()) {
    if ($last_round == 0) {
        $competitors = $tournament->get_competitors();
        $competitor_ids = array();
        foreach ($competitors as $competitor) {
            array_push($competitor_ids, $competitor->id);
        }
        $match_ids = generate_next_round($competitor_ids);
    } 
    else $competitor_ids = get_last_round_winners($tournament->id, $last_round, $database);
    $match_ids = generate_next_round($competitor_ids);

    $roundNum = $last_round+1;
    foreach ($match_ids as $match_pair) {
        $match_infomation = array();
        $match_infomation["tournamentID"] = $tournament->id;
        $match_infomation["roundNum"] = $roundNum;
        $match_infomation["matchDate"] = $_POST["matchDate"];
        $match_infomation["competitorID1"] = $match_pair["competitorID1"];
        $match_infomation["competitorID2"] = $match_pair["competitorID2"];
        $match = new Match($match_infomation);
        $result = $match->save();
    }
    redirect_to(url_for('officer/tournaments/tournamentMatches.php?id=' . $tournament->id));
}

else {
}

include(SHARED_PATH . '/officer_header.php');
?>

<div class="container mt-5 mb-5">

    <a class="back-link" href="<?php echo url_for('/officer/tournaments/tournaments.php'); ?>">&laquo; Back to List</a>
    <h1><?php echo h($tournament->name); ?></h1>
    <br>
    <?php
    if ($last_round > 0){
        for ($i = 1; $i < $last_round; $i++) {
            echo "ROUND " . ($i) . ": COMPLETE<br>";
        }
    }
    ?>

    <?php if (!$last_round_finished): ?>
        <?php echo "ROUND " . $last_round . ": IN PROGRESS";?>
        <br>
        <br>
        <a href="<?php echo url_for('/officer/tournaments/matchRecord.php?id=' . h(u($tournament->id)) . '&round=' . h(u($last_round))); ?>">RECORD MATCH RESULTS</a>
    <?php endif; ?>

    <?php if ($last_round_finished): ?>
        <?php if ($last_round > 0) echo "ROUND " . $last_round . ": COMPLETE"; ?>
        <?php if ($can_start): ?>
            <?php if ($winner_found != -1): ?>
                <br><br><h3>Tournament Complete</h3>
                <br>Winner: <?php echo $winner_found;?>
            <?php endif; ?>
            <br>
            <?php if ($winner_found == -1): ?>
                <form action="<?php echo url_for('/officer/tournaments/tournamentMatches.php?id=' . h(u($tournament->id))); ?>" method="post">
                    <div class="form-group">
                    <dl>
                        <dt>Match Date/Time</dt>
                        <dd><input type="date" class="form-control" name="matchDate" value="<?php echo date('Y-m-d'); ?>"/></dd>
                    </dl>
                    </div>
                    <div id="operations">
                        <input class= "btn btn-primary btn-lg" type="submit" value="Generate Next Round" />
                    </div>
                    </form>
                <br><br>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (!$can_start): ?>
            This tournament does not have a valid number of competitors (4, 8, 16 or 32).
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php
include(SHARED_PATH . '/footer.php');
?>