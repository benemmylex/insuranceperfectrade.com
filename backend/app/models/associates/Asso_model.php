<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/28/2017
 * Time: 5:24 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Asso_model extends CI_Model
{

    public function lockscreen () {
        $protocol = (strstr($_SERVER['SERVER_PROTOCOL'],"HTTPS")) ? "HTTPS://" : "HTTP://";
        set_flashdata('redirect',$protocol.get_url());
        redirect(base_url().'associate/lock');
    }

    public function unlockscreen ($passkey) {
        //$passkey = md5($passkey);
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)." AND passkey='$passkey'") == 1) {
            set_tempdata(A_UID,get_sessdata(UID),(15*60));
            redirect(get_sessdata('redirect'));
        }
    }

    public function check_associate () {
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)) == 1) {
            if (!strstr($_SERVER['REQUEST_URI'],'lock')) {
                $protocol = (strstr($_SERVER['SERVER_PROTOCOL'], "HTTPS")) ? "HTTPS://" : "HTTP://";
                set_flashdata('redirect', $protocol . get_url());
            }
            if (!is_tempdata(A_UID)) {
                if (!strstr($_SERVER['REQUEST_URI'],'lock')) {
                    redirect(base_url().'associate/lock');
                }
            } else {
                set_tempdata(A_UID,get_sessdata(UID),(15*60));
            }
        } else {
            redirect(base_url()."base");
        }
    }

    public function count_user_tasks ($uid='') {
        $uid = ($uid == '')?get_tempdata(A_UID):$uid;
        $s = $this->Db_model->selectGroup("*","associates_tasks","WHERE role=".$this->Util_model->get_info("associates_main","role","WHERE uid=".$uid)." AND status=1");
        $task_count = 0;
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $task_count += ($this->Util_model->row_count("associates_tasks_stats","WHERE taskID=$row[id] AND uid=$uid") == 0) ? 1 : 0;
            }
        }
        return $task_count;
    }

    public function show_user_tasks ($uid='') {
        $uid = ($uid == '')?get_tempdata(A_UID):$uid;
        $s = $this->Db_model->selectGroup("*","associates_tasks","WHERE role=".$this->Util_model->get_info("associates_main","role","WHERE uid=".$uid)." AND status=1");
        if ($s->num_rows() > 0) {
            $view = "<div class='box-group' id='accordion'>\n
                            \t<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->\n";
            $in = 'in';
            foreach ($s->result_array() as $row) {
                $ss = $this->Util_model->get_info("associates_tasks_stats","*","WHERE uid=$uid AND taskID=$row[id]");
                if (!$ss) {
                    $boarder = "danger";
                    $info = "<a href='".base_url()."associate/tasks/$row[id]' class='btn btn-primary btn-flat pull-right'>Mark as done</a>";
                } else {
                    if ($ss['confirm'] == 0) {
                        $boarder = "warning";
                        $info = "<span class='pull-right text-muted'>Submitted on $ss[done_date]</span>";
                    } else {
                        $boarder = "success";
                        $info = "<span class='pull-right text-muted'>Approved on $ss[confirm_date]</span>";
                    }
                }
                $view .=<<<view
                    <div class="panel box box-$boarder">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse$row[id]">
                                    $row[title]
                                </a>
                            </h4>
                        </div>
                        <div id="collapse$row[id]" class="panel-collapse collapse $in">
                            <div class="box-body">
                                <p>
                                    $row[content]
                                </p>
                                $info
                            </div>
                        </div>
                    </div>
view;
                $in = '';
            }
            $view .= "</div>";
        } else {
            $view = "<div class='well'>No task(s) as of now</div>";
        }
        return $view;
    }

    public function list_all_fixtures ($date=NULL) {
        $view =<<<view
            <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#live_all" data-toggle="tab">Live <span class="badge bg-green"></span></a></li>
              <li><a href="#open_all" data-toggle="tab">Open <span class="badge bg-yellow"></span></a></li>
              <li><a href="#closed_all" data-toggle="tab">Closed <span class="badge bg-red"></span></a></li>
              <li class="pull-left header"><i class="fa fa-calendar"></i> All Fixtures</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="live_all">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="open_all">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="closed_all">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
view;
        return $view;
    }

    public function list_my_fixtures ($date=NULL) {
        $view =<<<view
            
view;
        return $view;
    }

    public function view_sports () {
        $s = $this->Db_model->selectGroup("*","sports_main","ORDER BY title");
        if ($s->num_rows() > 0) {
            $view = '<ul class="list-group">
                <li class="list-group-item list-group-item-heading">All Sports</li>';
            foreach ($s->result_array() as $row) {
                if ($row['status'] == 0) {
                    $color = "text-red";
                    $btn = "<span class='badge bg-green-gradient pull-right pointer-cursor' title='Restore' onclick='if (confirm(\"Are you sure you want to restore $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-sports\",\"id=$row[id]&status=1\",_(\"sports-view\"),\"$row[title] restored successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-undo'></i></span>";
                } else {
                    $color = "";
                    $btn = "<span class='badge bg-yellow-gradient pull-right pointer-cursor' title='Trash' title='Restore' onclick='if (confirm(\"Are you sure you want to trash $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-sports\",\"id=$row[id]&status=0\",_(\"sports-view\"),\"$row[title] trashed successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-trash'></i></span>
                    <span class='badge bg-blue-gradient pull-right pointer-cursor' title='Update' onclick='_processAjax(\"".base_url()."ajax/update-sports\",\"id=$row[id]\",_(\"sports-form\"))'><i class='fa fa-pencil'></i></span>";
                }
                $view .=<<<view
                <li class='list-group-item $color'>
                    $row[title]
                    $btn
                </li>
view;
            }
            $view .= '</ul>';
        } else {
            $view = "<div class='well'>No sports found</div>";
        }
        return $view;
    }

        public function add_sports ($inputs) {
        if ($this->Util_model->row_count("sports_league","WHERE title='$inputs[sportTitle]'") == 0) {
            $input = array (
                "title"     =>  ucwords($inputs['sportTitle']),
                "desc"      =>  ucfirst($inputs['sportDesc']),
                "by"        =>  get_tempdata(A_UID)
            );
            if ($this->Db_model->insert("sports_main",$input)) {
                set_flashdata('msg',alert_msg("<i class='fa fa-check-circle-o'></i> Sports added successfully","alert-success",1));
                return true;
            } else {
                set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, try later","alert-danger",1));
                return false;
            }
        } else {
            set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, sports already exist","alert-danger",1));
            return false;
        }
    }

    public function add_league ($inputs) {
        if ($this->Util_model->row_count("sports_league","WHERE title='$inputs[leagueTitle]' AND sportsID=$inputs[leagueSport]") == 0) {
            $input = array (
                "title"         =>  ucwords($inputs['leagueTitle']),
                "sportsID"      =>  $inputs['leagueSport'],
                "by"            =>  get_tempdata(A_UID)
            );
            if ($this->Db_model->insert("sports_league",$input)) {
                set_flashdata('msg',alert_msg("<i class='fa fa-check-circle-o'></i> League added successfully","alert-success",1));
                return true;
            } else {
                set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, try later","alert-danger",1));
                return false;
            }
        } else {
            set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, league already exist","alert-danger",1));
            return false;
        }
    }

    public function view_leagues ($sportsID=NULL) {
        $sportsID = ($sportsID == NULL) ? $this->Util_model->get_info("sports_main","id","WHERE status=1") : $sportsID;

        $s = $this->Db_model->selectGroup("*","sports_main","WHERE status=1 ORDER BY title");
        if ($s->num_rows() > 0) {
            $li = "";
            foreach ($s->result_array() as $row) {
                $li .= "<li><a href='#' onclick='__processAjax(\"".base_url()."ajax/view_leagues\",\"sportsID=$row[id]\",_(\"league-view\"))'>$row[title]</a> </li>\n";
            }
        } else {
            $li = "<li>No sports yet</li>";
        }

        $view ="
            <div class='box box-default'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>".$this->Util_model->get_info("sports_main","title","WHERE id=$sportsID")." Leagues</h3>
                    <div class='box-tools pull-right'>
                        <div class='btn-group-open'>
                            <button type='button' class='btn btn-box-tool dropdown-toggle' data-toggle='dropdown' aria-expanded='true' title='Select sports to view'><i class='fa fa-search'></i></button>
                            <ul class='dropdown-menu' role='menu'>
                                $li
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='box-body' id='league-in-view'>";

        $s = $this->Db_model->selectGroup("*","sports_league","WHERE sportsID=$sportsID ORDER BY title");
        if ($s->num_rows() > 0) {
            $view .= "<div class='row'>";
            foreach ($s->result_array() as $row) {
                if ($row['status'] == 0) {
                    $color = "text-red";
                    $btn = "<span class='badge bg-green-gradient pull-right pointer-cursor' title='Restore' onclick='if (confirm(\"Are you sure you want to restore $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-league\",\"id=$row[id]&status=1&sportsID=$row[sportsID]\",_(\"league-view\"),\"$row[title] restored successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-undo'></i></span>";
                } else {
                    $color = "";
                    $btn = "<span class='badge bg-yellow-gradient pull-right pointer-cursor' title='Trash' title='Restore' onclick='if (confirm(\"Are you sure you want to trash $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-league\",\"id=$row[id]&status=0&sportsID=$row[sportsID]\",_(\"league-view\"),\"$row[title] trashed successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-trash'></i></span>
                    <span class='badge bg-blue-gradient pull-right pointer-cursor' title='Update' onclick='_processAjax(\"".base_url()."ajax/update-league\",\"id=$row[id]\",_(\"leagues-form\"))'><i class='fa fa-pencil'></i></span>";
                }
                $view .=<<<view
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                    <div class='well padding-1x $color'>
                        $row[title]
                        $btn
                    </div>
                </div>
view;
            }
            $view .= "</div>";
        } else {
            $view .= "<div class='well'>No league under the sports found</div>";
        }
        $view .= '
                </div>
            </div>';
        return $view;
    }

    public function add_competition ($inputs) {
        if ($this->Util_model->row_count("sports_competition","WHERE title='$inputs[compTitle]' AND sportsID=$inputs[compSport] AND leagueID=$inputs[compLeague]") == 0) {
            $input = array (
                "title"         =>  ucwords($inputs['compTitle']),
                "sportsID"      =>  $inputs['compSport'],
                "leagueID"      =>  $inputs['compLeague'],
                "by"            =>  get_tempdata(A_UID)
            );
            if ($this->Db_model->insert("sports_competition",$input)) {
                set_flashdata('msg',alert_msg("<i class='fa fa-check-circle-o'></i> Competition added successfully","alert-success",1));
                return true;
            } else {
                set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, try later","alert-danger",1));
                return false;
            }
        } else {
            set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, Competition already exist","alert-danger",1));
            return false;
        }
    }

    public function view_competition ($sportsID=NULL, $leagueID=NULL) {
        $sportsID = ($sportsID == NULL) ? $this->Util_model->get_info("sports_main","id","WHERE status=1") : $sportsID;
        $leagueID = ($leagueID == NULL) ? $this->Util_model->get_info("sports_league","id","WHERE sportsID=$sportsID AND status=1") : $leagueID;

        $s = $this->Db_model->selectGroup("*","sports_competition","WHERE sportsID=$sportsID AND leagueID=$leagueID ORDER BY title");
        if ($s->num_rows() > 0) {
            $view = "<div class='row'>";
            foreach ($s->result_array() as $row) {
                if ($row['status'] == 0) {
                    $color = "text-red";
                    $btn = "<span class='badge bg-green-gradient pull-right pointer-cursor' title='Restore' onclick='if (confirm(\"Are you sure you want to restore $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-competition\",\"id=$row[id]&status=1&sportsID=$row[sportsID]&leagueID=$row[leagueID]\",_(\"comp-view\"),\"$row[title] restored successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-undo'></i></span>";
                } else {
                    $color = "";
                    $btn = "<span class='badge bg-yellow-gradient pull-right pointer-cursor' title='Trash' title='Restore' onclick='if (confirm(\"Are you sure you want to trash $row[title]?\")) _processAjax(\"".base_url()."ajax/trash-restore-competition\",\"id=$row[id]&status=0&sportsID=$row[sportsID]&leagueID=$row[leagueID]\",_(\"comp-view\"),\"$row[title] trashed successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-trash'></i></span>
                    <span class='badge bg-blue-gradient pull-right pointer-cursor' title='Update' onclick='_processAjax(\"".base_url()."ajax/update-competition\",\"id=$row[id]\",_(\"comp-form\"))'><i class='fa fa-pencil'></i></span>";
                }
                $teams = $this->Util_model->row_count("sports_team_sharing","WHERE sportsID=$sportsID AND leagueID=$leagueID AND compID=$row[id]");
                $view .=<<<view
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                    <div class='well padding-1x $color'>
                        $row[title] | <b title='Total number of teams'>$teams</b>
                        $btn
                    </div>
                </div>
view;
            }
            $view .= "</div>";
        } else {
            $view = "<div class='well'>No competition found under ".$this->Util_model->get_info("sports_main","title","WHERE id=$sportsID")." and ".$this->Util_model->get_info("sports_league","title","WHERE id=$leagueID")."</div>";
        }
        return $view;
    }

    public function view_teams ($sportsID=NULL, $leagueID=NULL) {
        $sportsID = ($sportsID == NULL) ? $this->Util_model->get_info("sports_main","id","WHERE status=1") : $sportsID;
        $leagueID = ($leagueID == NULL) ? $this->Util_model->get_info("sports_league","id","WHERE sportsID=$sportsID AND status=1") : $leagueID;

        $s = $this->Db_model->selectGroup("*","sports_team","WHERE sportsID=$sportsID AND leagueID=$leagueID ORDER BY title");
        if ($s->num_rows() > 0) {
            $view = "<table id='teams-tbl' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>Team Title</th>
                  <th>Sports</th>
                  <th>League</th>
                  <th>Team Type</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>";
            foreach ($s->result_array() as $row) {
                if ($row['status'] == 0) {
                    $color = "text-red";
                    $btn = "<button type='button' class='btn btn-success btn-sm btn-flat pointer-cursor' title='Restore' onclick='if (confirm(\"Are you sure you want to restore $row[title]?\")) view_teams(_(\"teams-tbl\"),\"".base_url()."ajax/trash-restore-team\",\"id=$row[id]&status=1&sportsID=$row[sportsID]&leagueID=$row[leagueID]\",_(\"team-view\"),\"$row[title] restored successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-undo'></i></button>";
                } else {
                    $color = "";
                    $btn = "<button class='btn btn-primary btn-sm btn-flat pointer-cursor' title='Update' onclick='_processAjax(\"".base_url()."ajax/update-team\",\"id=$row[id]\",_(\"team-form\"))'><i class='fa fa-pencil'></i></button>
                    <button class='btn btn-danger btn-sm btn-flat pointer-cursor' title='Trash' title='Restore' onclick='if (confirm(\"Are you sure you want to trash $row[title]?\")) view_teams(_(\"teams-tbl\"),\"".base_url()."ajax/trash-restore-team\",\"id=$row[id]&status=0&sportsID=$row[sportsID]&leagueID=$row[leagueID]\",_(\"team-view\"),\"$row[title] trashed successfully\",\"success\",_(\"msg-alert\"))'><i class='fa fa-trash'></i></button>
                    ";
                }
                $sports = $this->Util_model->get_info("sports_main","title","WHERE id=$sportsID");
                $league = $this->Util_model->get_info("sports_league","title","WHERE sportsID=$sportsID AND id=$leagueID");
                $type = $this->Util_model->fetch_item_desc(67,$row['type']);
                //$sports = $this->Util_model->get_info()
                $view .=<<<view
                    <tr class="$color">
                      <td>$row[title]</td>
                      <td>$sports</td>
                      <td>$league</td>
                      <td>$type</td>
                      <td>$btn</td>
                    </tr>
view;
            }
            $view .= "
                </tbody>
                <tfoot>
                  <th>Team Title</th>
                  <th>Sports</th>
                  <th>League</th>
                  <th>Team Type</th>
                  <th>Actions</th>
                </tfoot>
            </table>";
        } else {
            $view = "<div class='well'>No team(s) found under ".$this->Util_model->get_info("sports_main","title","WHERE id=$sportsID")." and ".$this->Util_model->get_info("sports_league","title","WHERE id=$leagueID")."</div>";
        }
        return $view;
    }

    public function add_team ($inputs) {
        if ($this->Util_model->row_count("sports_team","WHERE title='$inputs[teamTitle]' AND sportsID=$inputs[teamSport] AND leagueID=$inputs[teamLeague]") == 0) {
            $input = array (
                "title"         =>  ucwords($inputs['teamTitle']),
                "sportsID"      =>  $inputs['teamSport'],
                "leagueID"      =>  $inputs['teamLeague'],
                "type"          =>  $inputs['teamType'],
                "by"            =>  get_tempdata(A_UID)
            );
            if ($this->Db_model->insert("sports_team",$input)) {
                set_flashdata('msg',alert_msg("<i class='fa fa-check-circle-o'></i> Team added successfully","alert-success",1));
                return true;
            } else {
                set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, try later","alert-danger",1));
                return false;
            }
        } else {
            set_flashdata('msg',alert_msg("<i class='fa fa-times-circle-o'></i> Unsuccessful, Team already exist","alert-danger",1));
            return false;
        }
    }

    public function team_sharing_tbl ($sportID, $leagueID, $compID) {
        if ($leagueID == 1) {
            $s = $this->Db_model->selectGroup("*","sports_team_","WHERE sportsID=$sportID AND type=2 ORDER BY title");
        } else if ($leagueID == 2) {
            $s = $this->Db_model->selectGroup("*","sports_team","WHERE sportsID=$sportID AND type=1 ORDER BY title");
        } else {
            $s = $this->Db_model->selectGroup("*","sports_team","WHERE sportsID=$sportID AND leagueID=$leagueID ORDER BY title");
        }
        if ($s->num_rows() > 0) {
            $view = "<div class='well'>
                <span class='no-display'><span id='sportID'>$sportID</span><span id='leagueID'>$leagueID</span><span id='compID'>$compID</span></span>
                ".$this->Util_model->get_info("sports_main","title","WHERE id=$sportID")." <i class='fa fa-long-arrow-right'></i> 
                ".$this->Util_model->get_info("sports_league","title","WHERE id=$leagueID")." <i class='fa fa-long-arrow-right'></i> 
                ".$this->Util_model->get_info("sports_competition","title","WHERE id=$compID")."
                <span class='badge chk-selected'>".$this->Util_model->row_count("sports_team_sharing","WHERE sportsID=$sportID AND leagueID=$leagueID AND compID=$compID")." </span> 
              </div>
              <table id='teams-share-tbl' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th><input type='checkbox' class='checkAll' onchange='check_uncheck($(this))'></th>
                  <th>Team Title</th>
                  <th>Sports</th>
                  <th>League</th>
                </tr>
                </thead>
                <tbody>";
            foreach ($s->result_array() as $row) {
                if ($row['status'] == 0) {
                    $color = "text-red";
                } else {
                    $color = "";
                }
                $chkd = ($this->Util_model->row_count("sports_team_sharing","WHERE sportsID=$sportID AND leagueID=$leagueID AND compID=$compID AND teamID=$row[id]") == 0) ? "" : "checked='checked'";
                $sports = $this->Util_model->get_info("sports_main","title","WHERE id=$sportID");
                $league = $this->Util_model->get_info("sports_league","title","WHERE id=$row[leagueID]");
                $view .=<<<view
                    <tr class="$color">
                      <td><input type='checkbox' class='checkbox' onchange='checkbox($(this))' value='$row[id]'></td>
                      <td>$row[title]</td>
                      <td>$sports</td>
                      <td>$league</td>
                    </tr>
view;
            }
            $view .= "
                </tbody>
                <tfoot>
                  <th><input type='checkbox' class='checkAll' onchange='check_uncheck($(this))'></th>
                  <th>Team Title</th>
                  <th>Sports</th>
                  <th>League</th>
                </tfoot>
            </table>
            <hr>
            <button type='button' class='btn btn-primary btn-sm btn-flat pull-right' onclick='update_sharing()'>Update Sharing</button>";
        } else {
            $view = "<div class='well'>No team(s) found under ".$this->Util_model->get_info("sports_main","title","WHERE id=$sportsID").", ".$this->Util_model->get_info("sports_league","title","WHERE id=$leagueID").", and ".$this->Util_model->get_info("sports_competition","title","WHERE id=$compID")."</div>";
        }
        return $view;
    }

}