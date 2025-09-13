<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/28/2017
 * Time: 8:41 AM
 */
class Soccer_model extends CI_Model
{
    private $soccer_key = "wGecPCFTuKVmVZK2";
    private $soccer_secret = "gCElFkNZbBk1Rpmn6BAVdfPH0K4VKOY1";


    public function add_countries () {
        $countries = $this->Main_model->get_country();
        foreach ($countries['countries'] as $country) {
            if ($this->Util_model->row_count("soccer_country","WHERE sportsID=1 AND name='$country'") == 0) {
                $data = array (
                    "sportsID"          =>  1,
                    "name"              =>  $country
                );
                $this->Db_model->insert("soccer_country",$data);
            }
        }
    }

    public function add_leagues ()
    {
        $league = $this->Main_model->get_league();
        foreach ($league['leagues'] as $league) {
            if ($this->Util_model->row_count("soccer_league", "WHERE sportsID=1 AND leagueID=$league[league_id]") == 0) {
                $data = array(
                    "sportsID"      => 1,
                    "countryCode"   => $league['country_code'],
                    "country"       => $league['country'],
                    "leagueID"      => $league['league_id'],
                    "name"          => $league['name'],
                    "season"        => $league['season'],
                    "season_start"  => $league['season_start'],
                    "season_end"    => $league['season_end'],
                    "flag"          => $league['flag'],
                    "logo"          => $league['logo'],
                    "status"        => 1
                );
                $this->Db_model->insert("soccer_league", $data);
            } else {
                $data = array(
                    "sportsID"      => 1,
                    "name"          => $league['name'],
                    "season"        => $league['season'],
                    "season_start"  => $league['season_start'],
                    "season_end"    => $league['season_end'],
                    "flag"          => $league['flag'],
                    "logo"          => $league['logo']
                );
                $this->Db_model->update("soccer_league", $data, "WHERE leagueID=$league[league_id]");
            }
            //return $league->league_id."<br>";
        }
    }

    public function add_fixtures ($date=NULL) {
        //var_dump($this->Main_model->get_event());
        $date = ($date == NULL) ? date_time('d') : $date;
        $count = 0;
        $fixtures = $this->Main_model->get_fixture("date", $date);
        foreach ($fixtures['fixtures'] as $match) {
            if ($this->Util_model->row_count("soccer_fixture","WHERE matchID=$match[fixture_id]") == 0) {
                $data = array(
                    "sportsID"      => 1,
                    "leagueID"      => $match['league_id'],
                    "round"         => $match['round'],
                    "matchID"       => $match['fixture_id'],
                    "home_id"       => $match['homeTeam_id'],
                    "away_id"       => $match['awayTeam_id'],
                    "home_name"     => $match['homeTeam'],
                    "away_name"     => $match['awayTeam'],
                    "home_score"    => ($match['goalsHomeTeam'] == NULL) ? 0 : $match['goalsHomeTeam'],
                    "away_score"    => ($match['goalsAwayTeam'] == NULL) ? 0 : $match['goalsAwayTeam'],
                    "ht_score"      => ($match['halftime_score'] == "-" || $match['halftime_score'] == NULL) ? '0 - 0' : $match['halftime_score'],
                    "ft_score"      => ($match['final_score'] == "-" || $match['final_score'] == NULL) ? '0 - 0' : $match['final_score'],
                    "penalty"       => $match['penalty'],
                    "status"        => $match['status'],
                    "shortStatus"   => $match['statusShort'],
                    "elapsed"       => $match['elapsed'],
                    "time_stamp"    => $match['event_timestamp'],
                    "kick_off"      => $match['event_date'],
                    "updated"       => date_time()
                );
                $this->Db_model->insert("soccer_fixture", $data);
                $count++;
            }
        }
        echo $count." fixtures added successfully";
    }

    public function update_results () {
        //var_dump($this->Main_model->get_event());
        $count = 0;
        $fixtures = $this->Main_model->get_fixture();
        foreach ($fixtures['fixtures'] as $match) {
            $status = $this->Util_model->get_info("soccer_fixture","status","WHERE matchID=$match[fixture_id]");
            if ($status != 'FT' || $status != 'PST' || $status != 'Canc' || $status != 'AET' || $status != 'AAW' || $status != 'ToFi') {
                $data = array(
                    "home_score"    => ($match['goalsHomeTeam'] == NULL) ? 0 : $match['goalsHomeTeam'],
                    "away_score"    => ($match['goalsAwayTeam'] == NULL) ? 0 : $match['goalsAwayTeam'],
                    "ht_score"      => ($match['halftime_score'] == "-" || $match['halftime_score'] == NULL) ? '0 - 0' : $match['halftime_score'],
                    "ft_score"      => ($match['final_score'] == "-" || $match['final_score'] == NULL) ? '0 - 0' : $match['final_score'],
                    "penalty"       => $match['penalty'],
                    "status"        => $match['status'],
                    "shortStatus"   => $match['statusShort'],
                    "elapsed"       => $match['elapsed'],
                    "kick_off"      => $match['event_date'],
                    "updated"       => date_time()
                );
                $this->Db_model->update("soccer_fixture", $data, "WHERE matchID=$match[fixture_id]");
                $count++;
            }
            /*} else if ($match->match_live == 0 && $match->match_status == "FT") {
                $data = array(
                    "home_score" => $match->match_hometeam_score,
                    "away_score" => $match->match_awayteam_score,
                    "home_ht_score" => $match->match_hometeam_halftime_score,
                    "away_ht_score" => $match->match_awayteam_halftime_score,
                    "status" => $match->match_status
                );
                $this->Db_model->update("soccer_fixture", $data, "WHERE matchID=$match->match_id");
                $count++;
            }*/
        }
    }

    public function update_games () {
        $s = $this->Db_model->selectGroup("id, matchID, prediction","games","WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $match = $this->Util_model->get_info("soccer_fixture","home_score, away_score, home_ht_score, away_ht_score, status","WHERE matchID=$row[matchID]");
                if ($match['status'] == 'Canc.' || $match['status'] == 'Postp.' || $match['status'] == 'AAW' || $match['status'] == 'AET' || $match['status'] == 'ToFi') {
                    $this->Db_model->delete("games","WHERE id=$row[id]");
                } else if ($match['status'] == 'FT') {
                    $this->Db_model->update("games",array('status'=>$this->Main_model->outcome( $row['prediction'],array('home'=>$match['home_score'],'away'=>$match['away_score']),array('home'=>$match['home_ht_score'],'away'=>$match['away_ht_score']) )), "WHERE id=$row[id]");
                }
            }
        }
        $this->update_tickets();
    }

    public function update_tickets () {
        $s = $this->Db_model->selectGroup("*","ticket","WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $ss = $this->Db_model->selectGroup("status","games","WHERE ticketID=$row[id]");
                $total = $ss->num_rows();
                if ($total > 0) {
                    $won = 0;
                    $loose = 0;
                    $pending = 0;
                    
                    foreach ($ss->result_array() as $row1) {
                        if ($row1['status'] == '0') {
                            $pending++;
                        } else if ($row1['status'] == '1') {
                            $won++;
                        } else if ($row1['status'] == '2') {
                            $loose++;
                        } 
                    }
                    
                    if ($pending == 0) {
                        if ($won == $total) {
                            $status = 1;
                            $this->add_point($this->Base_model->get_base_info($row['baseID'],'uid'),NULL, 'win');
                        } else if ($won < $total) {
                            $status = 2;
                            $this->add_point($this->Base_model->get_base_info($row['baseID'],'uid'),NULL,'win',-1);
                        }
                        $this->Db_model->update("ticket",array("status"=>$status),"WHERE id=$row[id]");
                        if ($this->Util_model->get_info("stacks","type","WHERE id=$row[stackID]") != '00') {
                            $this->Main_model->distribute_sub_share($row['baseID'],$row['stackID'],$status);
                        }
                    }
                }
            }
        }
    }

    public function livescore ($date = NULL) {
        $date = ($date == NULL) ? date_time('d') : $date;
        $view = "
            <div class='nav-tabs-custom'>
                <ul class='nav nav-tabs pull-right'>
                    <li class='pull-left header'>
                        <i class='fa fa-soccer-ball-o'></i> Livescore
                    </li>
            ";
        for ($i=2; $i>=0; $i--) {
            $full = get_next_prev_date($date, $i, 'next', 'Y-m-d');
            $short = get_next_prev_date($date, $i, 'next', 'm/d');
            $active = ($date == $full) ? "class='active'" : "";
            $display = ($full == date_time('d')) ? "Today" : $short;
            $view .= "<li $active>
                              <a href='".base_url()."livescore/$full'>$display</a>
                          </li>";
        }
        for ($i=1; $i<=2; $i++) {
            $full = get_next_prev_date($date, $i, 'prev', 'Y-m-d');
            $short = get_next_prev_date($date, $i, 'prev', 'm/d');
            $display = ($full == date_time('d')) ? "Today" : $short;
            $view .= "<li>
                              <a href='".base_url()."livescore/$full'>$display</a>
                          </li>";
        }

        $view .= "</ul>
                <div class='tab-content'>";

        if ($this->session->has_userdata('leagues')) unset($_SESSION['leagues']);

        $view .= "</div>
            </div>
            ";

        echo $view;
    }

    public function list_fixtures ($date)
    {
        $view = "";
        $ser = "";
        if (isset($_SESSION['leagueIDs'])) {
            $leagues = $this->session->userdata('leagueIDs');
            foreach ($leagues as $leag) {
                $ser .= " AND f.leagueID<>$leag AND l.leagueID<>$leag";
            }
        }

        $sql = "SELECT l.*, f.* FROM soccer_league l, soccer_fixture f WHERE l.leagueID = f.leagueID AND f.sportsID=1 $ser AND f.kick_off LIKE '$date%' ORDER BY l.top DESC, l.country, f.leagueID, f.time_stamp";
        //$s = $this->Db_model->selectGroup("*","soccer_fixture","WHERE sportsID=1 $ser AND kick_off LIKE '$date%' ORDER BY leagueID, time_stamp");
        $s = $this->Db_model->query($sql);
        if ($s->num_rows() > 0) {
            $league = 0;
            $count = 0;
            $totalCount = 5;
            foreach ($s->result_array() as $row) {
                $count++;
                if ($league != $row['leagueID']) {
                    //$totalCount--;
                    //$leag = $this->Db_model->select("*", "soccer_league", "WHERE leagueID=$row[leagueID]");
                    $img = ($row['flag'] == NULL) ? $row['logo'] : $row['flag'];
                    $view .= "
                            <div class='box no-border no-padding no-curve'>
                                <div class='box-header'>
                                    <div class='fixture-league'>
                                        <span><img src='$img' style='margin-right: 3px; width: 25px; height: 20px;' alt='$row[countryCode]'> $row[country] - $row[name]</span>
                                    </div>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-box-tool' type='button' data-widget='collapse'>
                                            <i class='fa fa-minus'></i>
                                        </button>
                                    </div>
                                </div>
                                <div class='box-body'>
                            ";
                }
                $view .= $this->list_fixtures_attach($row);
                if ($this->Util_model->row_count("soccer_fixture", "WHERE leagueID=$row[leagueID] AND kick_off LIKE '$date%'") == $count) {
                    $leagues[] = $row['leagueID'];
                    $view .= "
                        </div>
                    </div>
                    ";
                    $count = 0;
                    $totalCount--;
                    if ($totalCount == 0) break;
                }
                $league = $row['leagueID'];
            }
            $this->session->set_userdata('leagueIDs', $leagues);
            $query = $this->Db_model->query("SELECT DISTINCT leagueID FROM soccer_fixture WHERE kick_off LIKE '$date%'");
            if ($query->num_rows() == count($this->session->userdata('leagueIDs'))) {
                $return = [
                    "return" => $view,
                    "last" => true
                ];
            } else {
                $return = [
                    "return" => $view,
                    "last" => false
                ];
            }
        } else {
            $return = [
                "return" => $view,
                "last" => true
            ];
        }

        return json_encode($return);
    }

    public  function list_fixtures2 ($league) {
        $view = "";
        $s = $this->Db_model->selectGroup("*","soccer_fixture","WHERE leagueID=$league");
        if ($s->num_rows() > 0) {
            $date = "";
            $count = 0;
            foreach ($s->result_array() as $row) {
                $count++;
                $date = convert_timestamp($row['time_stamp'], 'Y-m-d');
                $dateTotal = $this->Util_model->num_rows("soccer_fixture","WHERE kick_off LIKE '$date%'");
                if ($count == 1) {
                    $leag = $this->Db_model->select("*", "soccer_league", "WHERE leagueID=$row[leagueID]");
                    $view = "<div class='well text-bold'><i class='fa fa-calendar'></i> $leag[country] - $leag[name]</div>";
                }

                if ($date != $row['date']) {
                    //$totalCount--;

                    $view .= "
                                <div class='box box-default box-solid'>
                                    <div class='box-header' style='padding-top: 0px; padding-bottom: 0px;'>
                                        <h5 class='box-title'>".convert_timestamp($row['time_stamp'], 'Y-m-d H:i:s')."</h5>
                                        <div class='box-tools pull-right'>
                                            <button class='btn btn-box-tool' type='button' data-widget='collapse'>
                                                <i class='fa fa-minus'></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class='box-body'>
                                ";
                }
                $view .= $this->list_fixtures_attach($row);
                if ($dateTotal == $count) {
                    $view .= "
                        </div>
                    </div>
                    ";
                    $count = 0;
                }
            }
        } else {
            $view = "<div class='well'><p>No match found for the league</p></div>";
        }

        return $view;
    }

    private function list_fixtures_attach ($match) {
        if ($match['shortStatus'] == 'NS' || $match['shortStatus'] == 'PST') {
            $score_home = "";
            $score_away = "";
        }  else {
            $score_home = "$match[home_score]";
            $score_away = "$match[away_score]";
        }

        $blink = ($match['shortStatus'] == 'NS' || $match['shortStatus'] == 'Canc' || $match['shortStatus'] == 'FT' || $match['shortStatus'] == 'HT' || $match['shortStatus'] == 'PST' || $match['shortStatus'] == 'AAW' || $match['shortStatus'] == 'AET' || $match['shortStatus'] == 'ToFi' ) ? "&nbsp;" : "<span class='bg-green blink'>&nbsp;</span>";
        if ($match['shortStatus'] == 'NS') {
            $time = convert_timestamp($match['time_stamp'], 'H:m');
            $status = "";
            if ($this->session->has_userdata('bet_slip')) {
                $slip = $this->session->userdata('bet_slip');
                if (array_key_exists("soccer_".$match['matchID'], $slip)) {
                    $selected = $slip["soccer_".$match['matchID']];
                } else {
                    $selected = 0;
                }
            } else {
                $selected = 0;
            }
            $prediction = "
                <div class='btn-group pull-right sm-0'>";
                    if ($selected == 9) {
                        $prediction .= "<button class='btn btn-danger btn-sm $match[matchID]_pick' onclick='add_to_slip(\"" . base_url() . "ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=9\",__(\"$match[matchID]_pick\"),$(this))'>O2.5</button>";
                    } else {
                        $prediction .= "<button class='btn btn-success btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=9\",__(\"$match[matchID]_pick\"),$(this))'>O2.5</button>";
                    }
                    if ($selected == 15) {
                        $prediction .= "<button class='btn btn-danger btn-sm $match[matchID]_pick' onclick='add_to_slip(\"" . base_url() . "ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=15\",__(\"$match[matchID]_pick\"),$(this))'>U2.5</button>";
                    } else {
                        $prediction .= "<button class='btn btn-success btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=15\",__(\"$match[matchID]_pick\"),$(this))'>U2.5</button>";
                    }
                $prediction .= "</div>
                <div class='btn-group pull-right right-1x'>";
                    if ($selected == 1) {
                        $prediction .= "<button class='btn btn-danger btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=1\",__(\"$match[matchID]_pick\"),$(this))'>1</button>";
                    } else {
                        $prediction .= "<button class='btn btn-success btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=1\",__(\"$match[matchID]_pick\"),$(this))'>1</button>";
                    }
                    if ($selected == 2) {
                        $prediction .= "<button class='btn btn-danger btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=2\",__(\"$match[matchID]_pick\"),$(this))'>X</button>";
                    } else {
                        $prediction .= "<button class='btn btn-success btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=2\",__(\"$match[matchID]_pick\"),$(this))'>X</button>";
                    }
                    if ($selected == 3) {
                        $prediction .= "<button class='btn btn-danger btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=3\",__(\"$match[matchID]_pick\"),$(this))'>2</button>";
                    } else {
                        $prediction .= "<button class='btn btn-success btn-sm $match[matchID]_pick' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$match[matchID]&preID=3\",__(\"$match[matchID]_pick\"),$(this))'>2</button>";
                    }
                $prediction .= "</div>";
        } else if ($match['shortStatus'] == '1H' || $match['shortStatus'] == '2H' || $match['shortStatus'] == '1ET' || $match['shortStatus'] == '2ET' || $match['shortStatus'] == 'PK') {
            $time = $blink." ".$match['elapsed'];
            $status = $match['shortStatus'];
            $prediction = "
                <div class='btn-group pull-right sm-0'>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                </div>
                <div class='btn-group pull-right right-1x'>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                </div>
            ";
        } else {
            $time = "";
            $status = $match['shortStatus'];
            $prediction = "
                <div class='btn-group pull-right sm-0'>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                </div>
                <div class='btn-group pull-right right-1x'>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                    <button class='btn btn-success btn-sm' disabled><i class='fa fa-lock'></i></button>
                </div>
            ";
        }

        $view = "
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 fixture'>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 no-padding right-pad-1x'>
                        <div class='fixture-time'>
                            $time<br>
                            <span style='font-weight: normal;'>$status</span>
                        </div>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6 no-padding right-pad-1x pointer-cursor' onclick='window.location = \"".base_url()."fixture/soccer/$match[matchID]/\"'>
                        <span class='no-display'>$match[matchID]</span>
                        <div class='fixture-home'>
                            $match[home_name] <span class='pull-right text-bold'>$score_home</span>
                        </div>
                        <div class='fixture-away'>
                            $match[away_name] <span class='pull-right text-bold'>$score_away</span>
                        </div>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-4 no-padding'>
                        $prediction
                    </div>
                    <div class='col-xs-12 no-padding'>
                        <small>
                            <!--<span class='text-green pull-left pointer-cursor'><i class='fa fa-line-chart'></i> analyse</span>-->
                            <span class='text-orange pull-right pointer-cursor' onclick='window.location = \"".base_url()."fixture/soccer/$match[matchID]\"'>more <i class='fa fa-angle-double-right'></i></span>
                        </small>
                    </div>
                </div>
        ";

        return $view;
    }

    /*public function fixture ($matchID) {
        $s = $this->Db_model->selectGroup("*", "soccer_fixture", "WHERE matchID=$matchID");
        if ($s->num_rows() > 0) {
            $view = "
            <div class='nav-tabs-custom'>
                <ul class='nav nav-tabs pull-right'>
                    <li>
                        <a href='javascript:;' onclick='___(\"".base_url()."ajax/fixture_details/$matchID\", \"\", _(\"fixture-content\");'>Details</a>
                    </li>
                    <li class='active'>
                        <a href='javascript:;' onclick='___(\"".base_url()."ajax/fixture_odds/$matchID\", \"\", _(\"fixture-content\");'>Picks</a>
                    </li>
                    <li class='pull-left header'>
                        <a href='javascript:;' class='btn btn-sm btn-primary' onclick='goBack()' title='Back' data-toggle='tooltip'><i class='fa fa-arrow-left'></i> Back</a>
                    </li>
                </ul>
                <div class='tab-content' id='fixture-content'>
                    ".$this->list_predictions_index($matchID)."
                </div>
            </div>";
        } else {
            $view = "
            <p class='text-red'>
                <i class='fa fa-times-circle'></i> Nothing found under this fixture
            </p>
            ";
        }
        return $view;
    }*/

    public function fixture ($matchID, $tab=1) {
        $sql = "SELECT l.country, l.name, f.* FROM soccer_league l, soccer_fixture f WHERE l.leagueID = f.leagueID AND f.matchID=$matchID";
        $s = $this->Db_model->query($sql);
        if ($s->num_rows() == 1)  {
            $match = $s->row_array();
            $head = "$match[country] - $match[name]";
            if ($match['shortStatus'] == "NS") {
                $score = "- : -";
                $status = "$match[shortStatus]";
            } else if ($match['shortStatus'] == 'Canc.' || $match['shortStatus'] == 'FT' || $match['shortStatus'] == 'HT' || $match['shortStatus'] == 'Postp.') {
                $score = "$match[home_score] - $match[away_score]";
                $status = "$match[shortStatus]";
            } else {
                $score = "$match[home_score] - $match[away_score]";
                $status = "$match[shortStatus] $match[elapsed]";
            }


            $blink = ($match['shortStatus'] == NULL || $match['shortStatus'] == 'Canc.' || $match['shortStatus'] == 'FT' || $match['shortStatus'] == 'HT' || $match['shortStatus'] == 'Postp.' || $match['shortStatus'] == 'AAW' || $match['shortStatus'] == 'AET' || $match['shortStatus'] == 'ToFi' ) ? "&nbsp;" : "<span class='bg-green blink'>&nbsp;</span>";
            $view = "
              <div class='box box-widget widget-user-2'>
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class='widget-user-header bg-blue-active' style='height: 200px'>
                  <div class='widget-user-image'>
                    <a href='javascript:;' class='btn btn-primary btn-sm' onclick='goBack()' title='Back' data-toggle='tooltip'><i class='fa fa-arrow-left'></i> Back</a>
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class='widget-user-username'><i class='icofont-football'></i> $head</h3>
                  <h5 class='widget-user-desc'>".convert_timestamp($match['time_stamp'], "D, j M Y h:i A")."</h5>
                  <div class='pull-left' style='width: 100%; padding: 10px 0px'>
                    <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5 text-right'>
                        $match[home_name]
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center'>
                        <span id='fix-update'>
                            $score
                            <p>$status</p>
                        </span>
                    </div>
                    <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5 text-left'>
                        $match[away_name]
                    </div>
                  </div>
                </div>";
                if ($tab == 1) {
                    $view .= " 
                    <div class='box-footer'>
                        <div class='nav-tabs-custom'>
                            <ul class='nav nav-tabs pull-right'>
                                <li>
                                    <a href='javascript:;' onclick='___(\"" . base_url() . "ajax/fixture_details/$matchID\", \"\", _(\"fixture-content\");'>Details</a>
                                </li>
                                <li class='active'>
                                    <a href='javascript:;' onclick='___(\"" . base_url() . "ajax/fixture_odds/$matchID\", \"\", _(\"fixture-content\");'>Picks</a>
                                </li>
                            </ul>
                            <div class='tab-content' id='fixture-content'>
                                " . $this->list_predictions_index($matchID) . "
                            </div>
                        </div>
                    </div>
                    ";
                } else {
                    $view .= " 
                    <div class='box-footer'>
                        <div class='nav-tabs-custom'>
                            <ul class='nav nav-tabs pull-right'>
                                <li class='active'>
                                    <a href='javascript:;' onclick='___(\"" . base_url() . "ajax/fixture_details/$matchID\", \"\", _(\"fixture-content\");'>Details</a>
                                </li>
                                <li>
                                    <a href='javascript:;' onclick='___(\"" . base_url() . "ajax/fixture_odds/$matchID\", \"\", _(\"fixture-content\");'>Picks</a>
                                </li>
                            </ul>
                            <div class='tab-content' id='fixture-content'>
                                The details comes here
                            </div>
                        </div>
                    </div>
                    ";
                }
              $view .= "</div>
            ";
        } else {
            $view = "<div class='well'>The fixture those not exist</div>";
        }
        return $view;
    }

    public function fixture_update($matchID) {
        $match = $this->Db_model->select("shortStatus, home_score, away_score, elapsed", "soccer_fixture", "WHERE matchID=$matchID");
        $match = $match->row_array();
        if ($match['shortStatus'] == "NS") {
            $score = "- : -";
            $status = "$match[shortStatus]";
        }  else {
            $score = "$match[home_score] - $match[away_score]";
            $status = "$match[shortStatus] $match[elapsed]";
        }
        return "$score <p>$status</p>";
    }

    /*public function list_predictions_index ($matchID) {
        $match = $this->Util_model->get_info("soccer_fixture", "home_name, away_name, time_stamp", "WHERE matchID=$matchID");
        if (date_inrange(convert_timestamp($match['time_stamp'], "Y-m-d H:i:s"), new_date_format(date_time(), 'Y-m-d H:i:s', 'Y-m-d H:i'))) {
            if ($this->session->has_userdata('bet_slip')) {
                $slip = $this->session->userdata('bet_slip');
                if (array_key_exists($matchID, $slip)) {
                    $selected = $slip[$matchID];
                } else {
                    $selected = 0;
                }
            } else {
                $selected = 0;
            }

            //$s = $this->Db_model->selectGroup("*","prediction_group","WHERE group_status=1");
            function sortByOrder($a, $b) {
                return $a['pos'] - $b['pos'];
            }
            $odds = $this->Main_model->get_odds($matchID);
            $view = "";
            if ($this->session->has_userdata('bet_slip')) {
                $slip = $this->session->userdata('bet_slip');
                if (array_key_exists($matchID, $slip)) {
                    $selected = $slip[$matchID];
                } else {
                    $selected = 0;
                }
            } else {
                $selected = 0;
            }
            $s = $this->Db_model->selectGroup("group_name", "prediction_group", "WHERE group_status=1");
            $pred = array();
            foreach ($s->result_array() as $row) {
                $pred[] = $row['group_name'];
            }

            foreach ($odds['odds'] as $key => $val) {
                if (count($val) == 2) {
                    $col_lg = 6;
                    $col_md = 6;
                    $col_sm = 6;
                    $col_xs = 6;
                } else if (count($val) == 3) {
                    $col_lg = 4;
                    $col_md = 4;
                    $col_sm = 6;
                    $col_xs = 6;
                } else {
                    $col_lg = 3;
                    $col_md = 3;
                    $col_sm = 6;
                    $col_xs = 12;
                }

                $key = str_replace("Nombre de", "Number of", $key);
                $key = str_replace("&", "and", $key);

                if (in_array($key, $pred)) {
                    $view .= "
                    <h5>$key</h5>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bottom-2x'>";
                        usort($val, 'sortByOrder');
                        foreach ($val as $pick) {
                            switch ($pick['label']) {
                                case '1':
                                    $pick['label'] = 'Home';
                                    break;
                                case '2':
                                    $pick['label'] = 'Away';
                                    break;
                                case 'N':
                                    $pick['label'] = 'Draw';
                                    break;
                                case '1/N':
                                    $pick['label'] = 'Home/Draw';
                                    break;
                                case 'N/1':
                                    $pick['label'] = 'Draw/Home';
                                    break;
                                case 'N/2':
                                    $pick['label'] = 'Draw/Away';
                                    break;
                                case 'N/N':
                                    $pick['label'] = 'Draw/Draw';
                                    break;
                                case '1/2':
                                    $pick['label'] = 'Home/Away';
                                    break;
                                case '1/1':
                                    $pick['label'] = 'Home/Home';
                                    break;
                                case '2/2':
                                    $pick['label'] = 'Away/Away';
                                    break;
                                case '2/N':
                                    $pick['label'] = 'Away/Draw';
                                    break;
                                case 'N / Yes':
                                    $pick['label'] = 'Draw / Yes';
                                    break;
                                case 'N / No':
                                    $pick['label'] = 'Draw / No';
                                    break;
                                case 'Draw / Yes':
                                    $pick['label'] = 'Draw/Yes';
                                    break;
                                case 'Draw / No':
                                    $pick['label'] = 'Draw/No';
                                    break;
                                case $match['home_name']:
                                    $pick['label'] = 'Home';
                                    break;
                                case $match['away_name']:
                                    $pick['label'] = 'Away';
                                    break;
                                default:
                                    $pick['label'] = $pick['label'];
                                    break;
                            }

                            if ($key == "Result and The 2 teams score") {
                                $label = explode(" / ", $pick['label']);
                                if (strstr($pick['label'], $match['home_name'])) {
                                    $label = "Home/$label[1]";
                                } else if (strstr($pick['label'], $match['away_name'])) {
                                    $label = "Away/$label[1]";
                                } else {
                                    $label = "$label[0]/$label[1]";
                                }
                                $pick['label'] = $label;
                            }

                            $pick['label'] = str_replace("Exactement", "Exactly", $pick['label']);
                            if ($selected === "$key|$pick[label]|$pick[odd]") {
                                $color = "bg-red-gradient";
                            } else {
                                $color = "bg-green-gradient";
                            }
                            $attr = ($this->session->has_userdata(UID)) ? "onclick='add_to_slip(\"$matchID\",$(this))'" : "data-toggle='tooltip' title='Please sign in to create a ticket'";
                            $view .= "<div class='col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs $color text-center pointer-cursor' style='padding:10px;' $attr><span class='no-display'>$key|$pick[label]|$pick[odd]</span><span class='pull-left'>$pick[label]</span><span class='pull-right'>$pick[odd]</span></div>";
                        }
                        $view .= "
                    </div>
                    ";
                }
            }
        } else {
            $view = "<div class='well'>Predictions are not available for this game</div>";
        }
        return $view;
    }*/

    public function list_predictions_index ($matchID) {
        $match = $this->Db_model->select("time_stamp","soccer_fixture","WHERE matchID=$matchID");
        if (date_inrange(convert_timestamp($match['time_stamp'], "Y-m-d H:i:s"), new_date_format(date_time(), 'Y-m-d H:i:s', 'Y-m-d H:i'))) {
            if ($this->session->has_userdata('bet_slip')) {
                $slip = $this->session->userdata('bet_slip');
                if (array_key_exists("soccer_".$matchID, $slip)) {
                    $selected = $slip["soccer_".$matchID];
                } else {
                    $selected = 0;
                }
            } else {
                $selected = 0;
            }

            $s = $this->Db_model->selectGroup("*","soccer_prediction_group","WHERE group_status=1");
            $view = "";
            foreach ($s->result_array() as $row) {
                $col = 12 / $row['group_tab'];
                $ss = $this->Db_model->selectGroup("*","soccer_prediction_main","WHERE pre_group=$row[id]");
                if ($ss->num_rows() > 0) {
                    $view .= "
                    <h5>$row[group_name] <i class='fa fa-info-circle' title='$row[group_desc]' data-toggle='tooltip'></i></h5>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bottom-2x'>";
                    foreach ($ss->result_array() as $pre) {
                        $color = ($selected == $pre['id']) ? "btn-danger" : "btn-success";
                        $view .= "<div class='col-lg-$col col-md-$col col-sm-$col col-xs-$col text-center' style='padding:10px;'>
                            <a class='btn btn-sm pick $color' href='javascript:;' style='width:100%' onclick='add_to_slip(\"".base_url()."ajax/add_to_slip\",\"matchID=soccer_$matchID&preID=$pre[id]\",__(\"pick\"),$(this))'>$pre[pre_name]</a>
                        </div>";
                    }
                    $view .= "
                    </div>
                    ";
                }

            }
        } else {
            $view = "<div class='well'>No market available for this game</div>";
        }
        return $view;
    }

}
?>