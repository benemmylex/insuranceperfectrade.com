<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/28/2017
 * Time: 8:41 AM
 */
class General_model extends CI_Model
{

    public function add_point ($owner, $uid, $type, $mult=1) {
        $point = 0;
        switch ($type) {
            case 'like':
                $point1 = 5 * $mult;
                $point2 = 2 * $mult;
                break;
            case 'watch':
                $point1 = 5 * $mult;
                $point2 = 2 * $mult;
                break;
            case 'subscribe':
                $point1 = 10 * $mult;
                $point2 = 5 * $mult;
                break;
            case 'win':
                $point1 = 0;
                $point2 = 15;
                break;
            case 'verify_email':
                $point1 = 500;
                $point2 = 100;
                break;
        }
        if ($uid != 0 || $uid != NULL) {
            $this->Db_model->update("user_profile",array("point"=>($this->Util_model->get_user_info($uid, 'point', 'profile') + $point1)), "WHERE uid=$uid");
        }
        if ($owner != 0 || $owner != NULL) {
            $this->Db_model->update("user_profile",array("point"=>($this->Util_model->get_user_info($owner, 'point', 'profile') + $point2)), "WHERE uid=$owner");
        }
    }

    public function add_reaction ($by, $ref, $ref_xtra, $type, $ele='') {
        switch ($type) {
            case 'like':
                if ($this->Util_model->row_count("stat","WHERE `by`='$by' AND ref=$ref AND ref_xtra='$ref_xtra' AND type='like'") == 0) {
                    $this->Db_model->insert("stat",array("by"=>$by, "ref"=>$ref, "ref_xtra"=>$ref_xtra, "type"=>"like"));
                } else {
                    $this->Db_model->delete("stat","WHERE `by`='$by' AND ref=$ref AND ref_xtra='$ref_xtra' AND type='like'");
                }
                break;
            case 'watch':
                if ($this->Util_model->row_count("stat","WHERE `by`='$by' AND ref=$ref AND ref_xtra='$ref_xtra' AND type='watch'") == 0) {
                    $this->Db_model->insert("stat",array("by"=>$by, "ref"=>$ref, "ref_xtra"=>$ref_xtra, "type"=>"watch"));
                } else {
                    $this->Db_model->delete("stat","WHERE `by`='$by' AND ref=$ref AND ref_xtra='$ref_xtra' AND type='watch'");
                }
                break;
            case 'reach':
                $by = (!$this->session->has_userdata(UID)) ? get_ip_address() : $this->session->userdata(UID);
                if ($this->Util_model->row_count("stat","WHERE `by`='$by' AND ref=$ref AND ref_xtra='$ref_xtra' AND type='reach'") == 0) {
                    $this->Db_model->insert("stat",array("by"=>$by, "ref"=>$ref, "ref_xtra"=>$ref_xtra, "type"=>"reach"));
                }
                break;
        }
        return $this->view_reaction($by, $ref, $ref_xtra, $ele);
    }

    public function view_reaction ($by, $ref, $ref_xtra, $ele) {
        $like_unlike = ($this->Util_model->row_count("stat","WHERE `by`='$by' AND ref=$ref AND type='like' AND ref_xtra='$ref_xtra'") == 0) ? "<i class='fa fa-heart-o'></i> Like" : "<i class='fa fa-heart'></i> Unlike";
        $like_opt = ($this->session->has_userdata(UID)) ? "onclick='processAjax(\"".base_url()."ajax/react\",\"ref=$ref&ref_xtra=$ref_xtra&type=like&ele=$ele\",_(\"$ele\"));'" : "data-toggle='tooltip' title='Sign in first'";
        $watch_opt = ($this->session->has_userdata(UID)) ? "onclick='processAjax(\"".base_url()."ajax/react\",\"ref=$ref&ref_xtra=$ref_xtra&type=watch&ele=$ele\",_(\"$ele\"));'" : "data-toggle='tooltip' title='Sign in first'";
        $like = "
            <button cass='btn btn-danger btn-xs' type='button' $like_opt>$like_unlike</button>
            <span class='pointer-cursor' data-toggle='tooltip' title='Click to see people that like this' onclick='dialog(\"".base_url()."ajax/view-reacts\",\"ref=$ref&ref_xtra=$ref_xtra&type=like\",\"gen-modal\",\"sm\");'>".count_format($this->Util_model->row_count("stat","WHERE ref=$ref AND ref_xtra='$ref_xtra' AND type='like'"))." likes</span>
        ";
        $watch_unwatch = ($this->Util_model->row_count("stat","WHERE `by`='$by' AND ref=$ref AND type='watch' AND ref_xtra='$ref_xtra'") == 0) ? "<i class='fa fa-eye-slash'></i> Watch" : "<i class='fa fa-eye'></i> Unwatch";
        $watch = "
            <button cass='btn btn-primary btn-xs' type='button' $watch_opt>$watch_unwatch</button>
            <span class='pointer-cursor' data-toggle='tooltip' title='Click to see people that are watching this' onclick='dialog(\"".base_url()."ajax/view-reacts\",\"ref=$ref&ref_xtra=$ref_xtra&type=watchers\",\"gen-modal\",\"sm\");'>".count_format($this->Util_model->row_count("stat","WHERE ref=$ref AND ref_xtra='$ref_xtra' AND type='watch'"))." watchers</span>
        ";
        $ser = ($this->session->has_userdata(UID)) ? " AND uid=".$this->session->userdata(UID) : "";
        if ($this->Util_model->row_count("base_main","WHERE id=".$this->Util_model->get_info("ticket","baseID","WHERE id=$ref").$ser) == 0) {
            $reach = "";
        } else {
            $reach = "Post reach ".count_format($this->Util_model->row_count("stat","WHERE ref=$ref AND ref_xtra='$ref_xtra' AND type='reach'"));
        }
        switch ($ref_xtra) {
            case "stack":
                return $like;
                break;
            case "ticket":
                return ($this->session->has_userdata(UID)) ? "$like $watch <span class='pull-right'>$reach</span>" : "";
                break;
        }
    }

    public function get_balance ($uid, $format=true, $bonus=false, $bonus_type=NULL, $today=NULL) {
        $today = ($today == NULL)? "" : "AND date LIKE '".date("Y-m-d")."'";
        if (!$bonus) {
            $credit = $this->Util_model->sum_field("user_wallet", "amount", "WHERE creditor=$uid AND status=1 $today");
            $debit = $this->Util_model->sum_field("user_wallet", "amount", "WHERE debitor=$uid AND (status=1 OR status=0) $today");
        } else {
            $bonus_type = ($bonus_type == NULL) ? "" : "AND type='$bonus_type'";
            $credit = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=$uid AND status=1 $bonus_type $today");
            $debit = $this->Util_model->sum_field("user_bonus", "amount", "WHERE debitor=$uid AND (status=1 OR status=0) $bonus_type $today");
        }

        $balance = $credit - $debit;
        if ($format) {
            return "<i class='fa fa-dollar'></i>".number_format($balance,2);
        } else {
            return $balance;
        }
    }

    public function get_currency ($uid) {
        $currency = $this->Util_model->get_info("countries","currency","WHERE id=".$this->Util_model->get_user_info($uid,'country','profile'));
        return $currency;
    }

    public function view_star ($uid) {
        $verified = $this->Util_model->get_user_info($uid,"verified","profile");
        if ($verified == 0) {
            $star = "";
        } else {
            $star = "<span class='text-green'><i class='fa fa-check-circle'></i></span>";
        }
        return $star;
    }

    public function slides () {
        $s = $this->Db_model->selectGroup("*","code_param_desc","WHERE tab_index=64 ORDER BY item_desc");
        $num = $s->num_rows();
        $slides = '<ol class="carousel-indicators">';
        for ($i=0; $i<$num; $i++) {
            $active = ($i == 0 ? "class='active'" : "");
            $slides .= "<li data-target='#carousel-example-generic' data-slide-to='$i' $active></li>";
        }
        $slides .= '</ol>';
        $slides .= '<div class="carousel-inner">';
        $count = 0;
        foreach ($s->result_array() as $row) {
            $active = ($count == 0 ? "active" : "");
            $slides .= "
        <div class='item $active'>
                <img src='".base_url()."$row[item_desc]' alt='$row[item_xdesc]'>

                <div class='carousel-caption'>
        $row[item_xdesc]
                </div>
            </div>
        ";
            $count++;
        }
        $slides .= '</div>';
        return $slides;
    }

    public function top_prediction () {
        $ticket = $this->Util_model->get_info("ticket","*","WHERE id=".$this->Util_model->get_option("ticket_of_the_day"));
        $s = $this->Db_model->selectGroup("*","games","WHERE ticketID=$ticket[id]");
            $view = "
        <div class='box box-widget widget-user-2'>
                <div class='widget-user-header bg-warning'>
                    <div class='widget-user-image'>
                        <img class='img-circle img-bordered-sm' src='".base_url().$this->Util_model->picture($ticket['baseID'],'base_main')."'/>
                    </div>
                    <h4 class='widget-user-username'>".$this->Main_model->get_base_link($ticket['baseID'],$this->Util_model->get_info("base_main","name","WHERE id=$ticket[baseID]"))."</h4>
                    <h5 class='widget-user-desc'>@".$this->Util_model->get_info("base_main","username","WHERE id=$ticket[baseID]")."</h5>
                </div>
                <div class='box-footer no-padding'>
                    <ul class='nav nav-stacked'>";
                foreach ($s->result_array() as $game) {
                    $match = $this->Util_model->get_info("sports_fixture","*","WHERE matchID=$game[matchID]");
                        $sports = $this->Util_model->get_info("sports_main","title","WHERE id=$match[sportsID]");
                        $country = ($match['countryID'] != 0) ? $this->Util_model->get_info("sports_country","name","WHERE countryID=$match[countryID]") : "Others";
                        $league = ($match['leagueID'] != 0) ? $this->Util_model->get_info("sports_league","name","WHERE leagueID=$match[leagueID]") : "Others";
                        $view .= "<li>
                            <a href='".base_url()."fixture/$game[matchID]'>
                               <b>$sports</b> - $country - $league <br>
        $match[time] $match[home_name] <span class='badge'>VS</span>  $match[away_name]
                               <span class='pull-right badge bg-green text-bold'>".$this->Util_model->get_info("prediction_main","pre_name","WHERE id=$game[prediction]")."</span>
                               
                        </li>";
                    }
                $view .="
                    </ul>
                </div>
            </div>
        ";
        return $view;
    }

    public function top_bases () {
        $s = $this->Db_model->selectGroup("*","top_suggestions","WHERE type='base' ORDER BY RAND() LIMIT 4");
        $view = "";
        $color = array("green","aqua","yellow","red");
        $count = 0;
        $base_ser = "";
        $this->load->model("users/Base_model");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $view .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-'.$color[$count].'">
                    <span class="info-box-icon"><i class="fa"><img src="'.base_url().$this->Util_model->picture($row['ref'],'base_main').'" class="img-circle img-md"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"><a href="'.$this->Base_model->get_base_url($row['ref']).'">'.$this->Base_model->get_base_info($row['ref'],'name').'</a> </span>
                      <span class="info-box-number" style="font-size:14px">@'.$this->Base_model->get_base_info($row['ref'],'username').'</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: '.$this->Base_model->get_base_percentage($row['ref']).'%"></div>
                      </div>
                          <div class="progress-description">
                            <span class="pull-left text-bold">Success rating</span>
                            <span class="pull-right text-bold">'.$this->Base_model->get_base_percentage($row['ref']).'%</span>
                          </div>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->';
                $count++;
            }
        }

        if ($count < 4) {
            $s = $this->Db_model->selectGroup("*","base_main","ORDER BY RAND() DESC LIMIT 4");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("top_suggestions","WHERE type='base' AND ref=$row[id]") == 0) {
                        $view .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-'.$color[$count].'">
                            <span class="info-box-icon"><i class="fa"><img src="'.base_url().$this->Util_model->picture($row['id'],'base_main').'" class="img-circle img-md"></i></span>
        
                            <div class="info-box-content">
                              <span class="info-box-text"><a href="'.$this->Base_model->get_base_url($row['id']).'">'.$this->Base_model->get_base_info($row['id'],'name').'</a> </span>
                              <span class="info-box-number" style="font-size:14px">@'.$this->Base_model->get_base_info($row['id'],'username').'</span>
            
                              <div class="progress">
                                <div class="progress-bar" style="width: '.$this->Base_model->get_base_percentage($row['id']).'%"></div>
                              </div>
                                  <div class="progress-description">
                                    <span class="pull-left text-bold">Success rating</span>
                                    <span class="pull-right text-bold">'.$this->Base_model->get_base_percentage($row['id']).'%</span>
                                  </div>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->';
                                if ($count == 3) break;
                                $count++;
                    }

                }
            }
        }
        return $view;
    }

    public function list_base ($uid=NULL) {
        $uid = ($uid == NULL) ? $this->session->userdata(UID) : $uid;
        $s = $this->Db_model->selectGroup("*","base_main","WHERE uid=$uid");
        $view = "";
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $view .= "<li><a href='".base_url()."base/$row[username]'>$row[name]</a></li>";
            }
        }
        $view .= "<li><a href='javascript:;' onclick='dialog(\"".base_url()."ajax/own-base\",\"create=new\",\"gen-modal\",\"sm\")'>Own a base</a></li>";
        echo $view;
    }

    public function own_base () {
        $view = "<div class='modal-header'>
            <h4 class='modal-title'>
                <i class='fa fa-home'></i> Own a base
        <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </h4> 
        </div>
        <div class='modal-body'>
            <div class='callout callout-info'>
                <p>Own a base by any of these means</p> 
            </div>
            <ul class='nav nav-stacked'>";
                if ($this->Util_model->row_count("base_main","WHERE uid=".$this->session->userdata(UID)) == 0) :
                $view .= "
            <li>
                    <a href='".base_url()."base/create-new'>Create new base <span class='label label-success pull-right'>free</span></a>
                </li>
        ";
                endif;
                $view .= "
                <li>
                    <a href='".base_url()."trade/buy-base'>Purchase base <span class='label label-warning pull-right'>paid</span></a>
                </li>
                <li>
                    <a href='".base_url()."trade/lease-base'>Lease base <span class='label label-warning pull-right'>paid</span></a>
                </li>
                <li>
                    <a href='".base_url()."base/rent-base'>Rent base <span class='label label-warning pull-right'>paid</span></a>
                </li>
            </ul>
        </div> ";
        return $view;
    }

    public function check_base_username ($username) {
        /*if (strstr($username,array("_",",",".","*","#","&","!","~","$","%","^","(",")","+","=","{","}","[","]",":",":","'","<",">","?","/"))) {
            $arr[0] = false;
            $arr[1] = "<span class='text-red'>Invalid characters contained</span>";
        } else {*/
        if ($this->Util_model->row_count("base_main","WHERE username='$username'") > 0) {
            $arr[0] = false;
            $arr[1] = "<span class='text-red'>Unavailable</span>";
        } else {
            $arr[0] = true;
            $arr[1] = "<span class='text-green'>Available</span>";
        }
        //}
        return $arr;
    }

    public function display_slip () {
        $view = "
            <div class='modal-header'>
                <h4 class='modal-title'>
                    <i class='fa fa-file'></i> Slip
                    <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
                </h4> 
            </div>
            <div class='modal-footer text-left'>
            ";
        if (isset($_SESSION['bet_slip']) && count($this->session->userdata('bet_slip')) > 0) {
            $slips = $this->session->userdata('bet_slip');
            foreach ($slips as $matchID => $pid) {
                $split = explode("_", $matchID);
                $matchID = $split[1];
                $sport = $split[0];
                $pred_main = $this->Db_model->select("pre_name, pre_group", $sport."_prediction_main", "WHERE id=$pid");
                $pred_group = $this->Util_model->get_info($sport."_prediction_group", "group_name", "WHERE id=$pred_main[pre_group]");
                $pred_name = $pred_main['pre_name'];
                $icon = $this->Util_model->get_info("sports_main", "icon", "WHERE keyword='$sport'");
                $sql = "SELECT l.country, l.name, f.* FROM ".$sport."_league l, soccer_fixture f WHERE l.leagueID = f.leagueID AND f.matchID=$matchID";
                $sql = $this->Db_model->query($sql);
                $match = $sql->row_array();
                if (date_inrange(convert_timestamp($match['time_stamp'], "Y-m-d H:i:s"), new_date_format(date_time(), 'Y-m-d H:i:s', 'Y-m-d H:i'))) {
                    $view .= "
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding'>
                        <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                            <i class='fa fa-times pointer-cursor' data-toggle='tooltip' title='Remove prediction' onclick='__processAjax(\"" . base_url() . "ajax/remove-prediction\",\"matchID=".$sport."_".$matchID."\",_(\"gen-modal-content\"))'></i>
                        </div>
                        <div class='col-lg-11 col-md-11 col-sm-11 col-xs-11'>
                            <h6><i class='$icon'></i> $match[country] - $match[name]</h6>
                            <h5 class='overflow text-bold'><a href='" . base_url() . "fixture/$sport/$matchID' class='text-black'>$matchID | $match[home_name] - $match[away_name]</a></h5>
                            <p class='text-gray' style='line-height: 10px'>
                                <small>$pred_group</small>
                                <span class='pull-right text-black text-bold' style='font-size: 18px;'>$pred_name</span>
                            </p>
                        </div>
                    </div>
                    ";
                } else {
                    $view .= "
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding'>
                        <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                            <i class='fa fa-times pointer-cursor' data-toggle='tooltip' title='Remove prediction' onclick='__processAjax(\"" . base_url() . "ajax/remove-prediction\",\"matchID=".$sport."_".$matchID."\",_(\"gen-modal-content\"))'></i>
                        </div>
                        <div class='col-lg-11 col-md-11 col-sm-11 col-xs-11'>
                            <h6><i class='$icon'></i> $match[country] - $match[name]</h6>
                            <h5 class='overflow text-bold'><a href='" . base_url() . "fixture/$sport/$matchID' class='text-black'>$matchID | $match[home_name] - $match[away_name]</a></h5>
                            <p class='text-gray' style='line-height: 10px'>
                                <small>$pred_group</small>
                                <span class='label label-default pull-right text-black'>suspended</span>
                            </p>
                        </div>
                    </div>
                    ";
                }
            }
            if (isset($_SESSION[UID])) {
                $view .= "
                <div class='col-xs-12 td_overline top-pad-1x top-1x text-center' style='padding-left:0px; padding-right:0px; font-size:18px; font-weight:bold'>
                    Total Odds &nbsp;<input type='number' step='0.01' class='text-center' style='width:75px' id='slip-odd' min='1'>
                </div>
                <div class='col-xs-12 td_overline  top-1x' style='padding:10px 0px; background-color: #f1f6f6'>
                    <div id='booking'>
                        <div class='col-xs-12 bottom-1x'>
                            <span class='pull-left' style='font: bold 13px Calibri; color: #557093'>Booking Numbers</span>
                            <span class='pull-right font-sm text-orange pointer-cursor' onclick='$.post(\"".base_url()."ajax/add_booking_number\", \"\", function(data) { _(\"booking\").append(data); })'>+add more</span>
                        </div>
                        <div class='col-xs-6' style='padding-right:5px;'>
                            <div class='form-group-sm'>
                                <select class='form-control book-site' data-toggle='tooltip' title='Select betting site'>
                                    <option value=''>--Select betting site--</option>
                                    ".$this->Util_model->list_from_table("bet_sites","id","name","WHERE status=1 ORDER BY name")."
                                </select>
                            </div>
                        </div>
                        <div class='col-xs-6' style='padding-left:5px;'>
                            <div class='form-group-sm'>
                                <input type='text' class='form-control book-num' placeholder='Booking number'>
                            </div>
                        </div>
                    </div>
                    <div class='col-xs-12 bottom-1x top-2x'>
                        <span class='pull-left' style='font: bold 13px Calibri; color: #557093'>Description</span>
                        <div class='form-group-sm'>
                            <textarea class='form-control' row='7' id='slip-desc' style='resize: none;' placeholder='Write an instruction or a comment'></textarea>
                        </div>
                    </div>
                </div>
                <div class='col-xs-12 td_overline top-pad-1x top-1x' style='padding-left:0px; padding-right:0px;'>
                ";
                if ($this->Util_model->row_count("base_main", "WHERE uid=".$this->session->userdata(UID)) > 0) :
                    $view .= "
                    <div class='col-xs-6' style='padding-right:5px;'>
                        <div class='form-group-sm'>
                            <select class='form-control' data-toggle='tooltip' title='Select base' id='slip-base' onchange='processAjax(\"".base_url()."ajax/get_stack_sel\",\"baseID=\"+$(this).val(),_(\"slip-stack\"))'>
                                <option value=''>--Select base--</option>
                                ".$this->Util_model->list_from_table("base_main","id","name","WHERE uid=".$this->session->userdata(UID))."
                            </select>
                        </div>
                    </div>
                    <div class='col-xs-6' style='padding-left:5px;'>
                        <div class='form-group-sm'>
                            <select class='form-control' data-toggle='tooltip' title='Select stack' id='slip-stack'>
                                <option value=''>--Select base first--</option>
                            </select>
                        </div>
                    </div>
                    <div class='col-xs-12 no-padding' id='slip-footer'></div>
                    ";
                else :
                    $view .= "<a href='javascript:;' class='text-orange left-pad-2x' onclick='dialog(\"".base_url()."ajax/own-base\",\"create=new\",\"gen-modal\",\"sm\")'>Create a <b>BASE</b> to post ticket</a>";
                endif;
                $view .= "
                </div>
                <div class='col-xs-12 td_overline top-pad-1x top-1x'>
                    <div class='btn-group text-right'>
                        <button class='btn btn-danger' onclick='__processAjax(\"".base_url()."ajax/clear-ticket\",\"\",_(\"gen-modal-content\"))'><i class='fa fa-times'></i> Clear slip</button>
                        <button class='btn btn-success' onclick='if (___(\"slip-base\") == \"\" || ___(\"slip-stack\") == \"\") { alert(\"BASE or STACK not selected\"); } else { create_ticket(\"".base_url()."ajax/create_ticket\") }'>Create ticket <i class='fa fa-check'></i></button>
                    </div>
                </div>
                ";
            } else {
                $view .= "
                    <div class='col-xs-12 td_overline top-pad-1x top-1x'>
                        <div class='btn-group'>
                            <a class='btn btn-primary' href='".base_url()."sign-in' title='Sign in to create a ticket' data-toggle='tooltip'>Sign In</a>
                            <button class='btn btn-danger' onclick='__processAjax(\"".base_url()."ajax/clear-ticket\",\"\",_(\"gen-modal-content\"))'><i class='fa fa-times'></i> Clear slip</button>
                        </div>
                    </div>
                ";
            }
        } else {
            $view .= "<div class='well'>Slip is empty</div>
            </div>";

        }
        echo $view;
    }

    public function create_ticket ($odd, $book, $desc, $base_id, $stack_id) {
        $stack = $this->Util_model->get_info("stacks","*","WHERE baseID=$base_id AND id=$stack_id");
        $error = 0;
        if ($stack['type'] != '00') {
            /*if ($this->Util_model->row_count("ticket","WHERE baseID=$base_id AND stackID=$stack_id") >= $this->Util_model->get_option("max_in_ticket")) {
                $this->session->set_flashdata("msg",alert_msg("<i class='fa fa-times-circle'></i> Maximum daily of ".$this->Util_model->get_option("max_in_ticket")." tickets for stacks exceeded","alert-danger",1));
                return true;
            }*/
            if ($this->Util_model->row_count("ticket","WHERE baseID=$base_id AND stackID=$stack_id") > $stack['stack_limit']) {
                $return = [
                    "return"    =>  0,
                    "content"   =>  "<i class='fa fa-times-circle'></i> You have reached the maximum number of $stack[stack_limit] tickets on this stack. "
                ];
                $error = 1;
            }
        }
        $slips = $this->session->userdata('bet_slip');
        if ($error == 0) {
            foreach ($slips as $matchID => $preID) {
                $split = explode("_", $matchID);
                $matchID = $split[1];
                $sport = $split[0];
                $match = $this->Util_model->get_info($sport . "_fixture", "*", "WHERE matchID=$matchID");
                if (!date_inrange(convert_timestamp($match['time_stamp'], "Y-m-d H:i:s"), new_date_format(date_time(), 'Y-m-d H:i:s', 'Y-m-d H:i'))) {
                    $return = [
                        "return" => 0,
                        "content"=> "<i class='fa fa-times-circle'></i> Some games are unavailable"
                    ];
                    $error = 1;
                    break;
                }
            }
        }
        if ($error == 0) {
            $data = array(
                "ticketID"      =>  $this->Util_model->generate_id(10000000, 99999999, "ticket", "ticketID", "varchar", true),
                "baseID"        =>  $base_id,
                "stackID"       =>  $stack_id,
                "booking_num"   =>  rtrim($book, "|"),
                "odd"           =>  $odd
            );
            if ($this->Db_model->insert("ticket",$data)) {
                $ticketID = $this->Util_model->get_info("ticket","ticketID","WHERE baseID=$base_id AND stackID=$stack_id ORDER BY id DESC");
                foreach ($slips as $matchID => $preID) {
                    $split = explode("_", $matchID);
                    $matchID = $split[1];
                    $sport = $split[0];
                    $data = array(
                        "ticketID"          =>  $ticketID,
                        "sportsID"           =>  $this->Util_model->get_info("sports_main", "id", "WHERE keyword='$sport'"),
                        "matchID"           =>  $matchID,
                        "prediction"        =>  $preID
                    );
                    $this->Db_model->insert("games",$data);
                }
                $data = [
                    "uid"           =>  $this->session->userdata(UID),
                    "refID"         =>  $base_id,
                    "content"       =>  $desc,
                    "type"          =>  "ticket",
                    "extra"         =>  $ticketID
                ];
                $this->Db_model->insert("posts", $data);
                $return = [
                    "return" => 1,
                    "content"=> "
                    <div class='modal-header'>
                        Success
                        <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    </div>
                    <div class='modal-body'>
                        <p class='text-center text-green'><i class='fa fa-check-circle-o fa-5x'></i></p>
                        <p class='text-center'>Ticket created successfully</p>
                        <div class='text-center'>
                            <button class='btn btn-primary btn-sm' onclick='recreate_ticket(\"".base_url()."ajax/recreate_ticket\", $(this))'>Recreate Ticket</button>
                        </div>
                    </div>
                    "
                ];
                $this->session->set_tempdata("slip", $this->session->userdata('bet_slip'), 3600);
                unset($_SESSION['bet_slip']);
            }
        }

        return json_encode($return);
    }

    private function get_following ($follower, $type='user') {
        if ($type == 'base') {
            $s = $this->Db_model->selectGroup("*","base_followers","WHERE follower=$follower");
            $result = array();
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $result[] = $row['following'];
                }
            }
        } else {
            $s = $this->Db_model->selectGroup("*","connect","WHERE follower=$follower");
            $result = array();
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $result[] = $row['following'];
                }
            }
        }
        return $result;
    }

    private function get_suggested_base ($uid, $top_suggestions=8, $total_suggestions=16) {
        $my_bases = "";
        if ($uid != NULL) {
            $s = $this->Db_model->selectGroup("id","base_main","WHERE uid=$uid");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $my_bases .= "ref<>$row[id] OR ";
                }
                $my_bases = "AND (".rtrim($my_bases, " OR ").")";
            }
        }

        $s = $this->Db_model->selectGroup("*","top_suggestions","WHERE type='base' $my_bases ORDER BY RAND()");
        $sug = array();
        $sugs = array();
        if ($s->num_rows() > 0) {
            $count = 0;
            foreach ($s->result_array() as $row) {
                if ($this->Util_model->row_count("base_followers","WHERE baseID=$row[ref] AND follower=$uid") == 0) {
                    $sug[] = $row['id'];
                    $count++;
                }
                if ($count == $top_suggestions) {
                    break;
                }
            }
        }

        $my_bases = "";
        if ($uid != NULL) {
            $s = $this->Db_model->selectGroup("id","base_main","WHERE uid=$uid");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $my_bases .= "id<>$row[id] OR ";
                }
                $my_bases = "WHERE (".rtrim($my_bases, " OR ").")";
            }
        }

        if (count($sug) < $total_suggestions) {
            $s = $this->Db_model->selectGroup("*","base_main","$my_bases ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if (!in_array($row['id'], $sug)) {
                        if ($uid != NULL) {
                            if ($this->Util_model->row_count("base_followers","WHERE baseID=$row[id] AND follower=$uid") == 0) {
                                $sug[] = $row['id'];
                            }
                        } else {
                            $sug[] = $row['id'];
                        }

                    }
                }
            }
        }

        return $sug;
    }

    private function get_suggested ($uid, $top_suggestions=3, $total_suggestions=8) {
        $s = $this->Db_model->selectGroup("*","top_suggestions","WHERE uid<>$uid ORDER BY RAND()");
        $sug = array();
        $sugs = array();
        if ($s->num_rows() > 0) {
            $count = 0;
            foreach ($s->result_array() as $row) {
                if ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$row[uid]") == 0) {
                    $sug[] = $row['uid'];
                    $count++;
                }
                if ($count == $top_suggestions) {
                    break;
                }
            }
        }
        if (count($sug) >= 0 && count($sug) < $total_suggestions) {
            $my_f = $this->get_following($uid); // People i'm following
            if (count($my_f) > 0) {
                foreach ($my_f as $my_f1) {
                    $my_ff = $this->get_following($my_f1); // People the person i'm following is following
                    if (count($my_ff) > 0) {
                        foreach ($my_ff as $my_ff1) {
                            $sugs[] = $my_ff1;
                            $my_fff = $this->get_following($my_ff1); // People the person following the person I'm following are following
                            if (count($my_fff) > 0) {
                                foreach ($my_fff as $my_fff1) {
                                    $sugs[] = $my_fff1;
                                }
                            }
                        }
                    }
                }
            }
            if (count($sugs) > 0) {
                $count = 0;
                shuffle($sugs);
                foreach ($sugs as $f_id) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$f_id") == 0 && !in_array($f_id,$sug)) {
                        $sug[] = $f_id;
                        $count++;
                    }
                    if (($count + $top_suggestions) == $total_suggestions) {
                        break;
                    }
                }
            }
        }
        if (count($sug) < $total_suggestions) {
            if (!isset($count)) $count = 0;
            $s = $this->Db_model->selectGroup("uid","user_profile","WHERE uid<>$uid AND country='".$this->Util_model->get_info('user_profile','country',"WHERE uid=$uid")."' ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$row[uid]") == 0 && !in_array($row['uid'],$sug)) {
                        $sug[] = $row['uid'];
                        $count++;
                    }
                    if (($count + count($sug)) == $total_suggestions) {
                        break;
                    }
                }
            }
        }
        if (count($sug) < $total_suggestions) {
            if (!isset($count)) $count = 0;
            $s = $this->Db_model->selectGroup("uid","user_profile","WHERE uid<>$uid ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$row[uid]") == 0 && !in_array($row['uid'],$sug)) {
                        $sug[] = $row['uid'];
                        $count++;
                    }
                    if (($count + count($sug)) == $total_suggestions) {
                        break;
                    }
                }
            }
        }

        if (in_array($this->session->userdata(UID), $sug)) {
            $key = array_search($this->session->userdata(UID),$sug);
            unset($sug[$key]);
            array_values($sug);
        }
        return $sug;
    }

    public function view_suggested_base_mini ($uid, $top=4, $total=8) {
        // Num of top suggested members
        // Total number of members to suggest
        $suggested = $this->get_suggested_base($uid, $top, $total);
        $view = '
         <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Bases</h3>

                <div class="box-tools pull-right">
                    <span class="label label-danger">Bases you may follow</span>
                    <button type="button" class="btn btn-box-tool" onclick="processAjax(\''.base_url().'ajax/view-base-mini-suggestion\',\'uid='.$uid.'\',_(\'mini_base_suggestion\'))"><i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="mini_base_suggestion">
                <ul class="users-list clearfix">';
        foreach ($suggested as $s_id) { //$s_id: suggested id
            $view .= "<li>
                        <img src='".base_url().$this->Util_model->picture($s_id, 'base_main')."' alt='Base Image'>";
            $view .= "<a href='".$this->Base_model->get_base_url($s_id)."'>".$this->Base_model->get_base_info($s_id, 'name')."</a>";
            $view .= "<span  class='users-list-date'>@".$this->Base_model->get_base_info($s_id,'username')."</span><br>";
            if ($uid != NULL) {
                $view .= ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$s_id") == 0) ? "<a href='javascript:;' id='sug-mini-$s_id' onclick='follow_unfollow(\"$uid\",\"$s_id\",\"follow\",\"mini\",_(\"sug-mini-$s_id\"),\"base\")'>Follow</a>" : "";
            }
            $view .= "</li>";
        }
        $view .= '
                </ul>
            </div>
            <div class="box-footer text-center">
                <a href="'.base_url().'home/bases#bases" class="uppercase">View More Bases</a>
            </div>
        </div>';
        return $view;
    }

    public function view_suggested_mini ($uid) {
        $top = 3; // Num of top suggested members
        $total = 8; // Total number of members to suggest
        $suggested = $this->get_suggested($uid, $top, $total);
        $view = '<ul class="users-list clearfix">';
        foreach ($suggested as $s_id) { //$s_id: suggested id
            $view .= "<li>
                        <img src='".base_url().$this->Util_model->picture($s_id)."' alt='User Image'>";
            $view .= $this->Main_model->get_user_link($s_id,"@".$this->Util_model->get_user_info($s_id,'username','profile'));
            $view .= "<span  class='users-list-date'>".$this->General_model->view_star($s_id)."</span><br>";
            $view .= ($this->Util_model->row_count("connect","WHERE follower=$uid AND following=$s_id") == 0) ? "<a href='javascript:;' id='sug-mini-$s_id' onclick='follow_unfollow(\"".base_url()."\",\"$uid\",\"$s_id\",\"follow\",\"mini\",_(\"sug-mini-$s_id\"))'>Follow</a>" : "";
            $view .= "</li>";
        }
        $view .= '</ul>';
        return $view;
    }

    public function get_suggested_stacks ($uid, $top_suggestions=16, $total_suggestions=32) {
        if ($uid != NULL) {
            $s = $this->Db_model->selectGroup("id", "base_main", "WHERE uid=$uid");
            $my_bases = "";
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $my_bases .= "baseID=$row[id] OR ";
                }
                $my_bases = "WHERE ".rtrim($my_bases, " OR ");
            }
        } else $my_bases = "";

        if ($uid != NULL) {
            $s = $this->Db_model->selectGroup("id","stacks","$my_bases ORDER BY RAND()");
            $my_stacks = "";
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $my_stacks .= "ref<>$row[id] OR ";
                }
                $my_stacks = "AND ".rtrim($my_stacks," OR ");
            }
        } else {
            $my_stacks = "";
        }


        $s = $this->Db_model->selectGroup("*", "top_suggestions", "WHERE type='stack' $my_stacks ORDER BY RAND()");
        $sug = array();
        if ($s->num_rows() > 0) {
            $count = 0;
            foreach ($s->result_array() as $row) {
                if ($uid == NULL) {
                    $sug[] = $row['ref'];
                    $count++;
                } else if ($this->Util_model->row_count("user_subscription", "WHERE uid=$uid AND stackID=$row[ref] AND status=1") == 0) {
                    $sug[] = $row['ref'];
                    $count++;
                }
                if ($count == $top_suggestions) {
                    break;
                }
            }
        }


        if (count($sug) < $total_suggestions) {
            $ser = ($my_stacks == "") ? "" : str_replace("ref","id", $my_stacks);
            $ser = ($ser == "") ? "" : "WHERE ".str_replace("OR","AND", ltrim($ser,"AND "));
            $s = $this->Db_model->selectGroup("id", "stacks", "$ser ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if (!in_array($row['id'], $sug)) {
                        if ($uid == NULL) {
                            $sug[] = $row['id'];
                        } else if ($this->Util_model->row_count("user_subscription", "WHERE uid=$uid AND stackID=$row[id] AND subStatus=1") == 0) {
                            $sug[] = $row['id'];
                        }
                    }
                }
            }
        }

        return $sug;
    }

    public function view_suggested_stack_mini ($uid, $top_suggestions=24, $total_suggestions=32) {
        $this->load->model("users/Base_model");
        $suggested = $this->get_suggested_stacks($uid, $top_suggestions, $total_suggestions);
        $view = '
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Stacks</h3>

                <div class="box-tools pull-right">
                    <span class="label label-danger">Stacks you may subscribe to</span>
                    <button type="button" class="btn btn-box-tool" onclick="processAjax(\''.base_url().'ajax/view-stack-mini-suggestion\',\'uid='.$uid.'\',_(\'mini_stack_suggestion\'))"><i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="mini_stack_suggestion">
                <ul class="users-list clearfix">';
        foreach ($suggested as $s_id) { //$s_id: suggested id
            $stack = $this->Util_model->get_info("stacks","*","WHERE id=$s_id");
            $view .= "<li class='text-center'>";
            $view .= "<h3>".$this->Base_model->get_stack_percentage($s_id)."%</h3>";
            $view .= "<a href='".$this->Base_model->get_base_url($stack['baseID'])."/stack/$s_id' style='font-size:14px; font-weight:bold;'>".text_continue($stack['name'])."</a><br>";
            if ($stack['type'] != "00") {
                $view .= "<a href='".$this->Base_model->get_base_url($stack['baseID'])."/user-subscribe/$s_id'>subscribe</a>";
            } else {
                $view .= "&nbsp;";
            }
            $view .= "</li>";
        }
        $view .= '
                </ul>
            </div>
            <div class="box-footer text-center">
                <a href="'.base_url().'home/stacks#stacks" class="uppercase">View More Stacks</a>
            </div>
        </div>';
        return $view;
    }

    public function list_won_ticket ($count=10) {
        $today = date_time();
        $loops = 0;
        $yesterday = get_next_prev_date(date_time('d'), 1, 'prev', 'Y-m-d');
        $tickets = array();
        if ($this->session->has_userdata(UID)) {
            $followed = "";
            $s = $this->Db_model->selectGroup("baseID","base_followers","WHERE follower=".$this->session->userdata(UID));
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $followed .= "baseID=$row[baseID] OR ";
                }
                $followed = rtrim($followed, " OR ");
            }
            if ($followed != "") {
                $s = $this->Db_model->selectGroup("id","ticket","WHERE $followed AND status=1 AND date between '$yesterday 00:00:00' AND '$today' ORDER BY date DESC");
                if ($s->num_rows() > 0) {
                    foreach ($s->result_array() as $row) {
                        $tickets == 0;
                        $loops++;
                        $tickets[] = $row['id'];
                    }
                }
            }

        }

        if (count($tickets) < $count) {
            $s = $this->Db_model->selectGroup("id","ticket","WHERE status=1 AND date between '$yesterday 00:00:00' AND '$today' ORDER BY date DESC");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if (!in_array($row['id'],$tickets)) {
                        $loops++;
                        $tickets[] = $row['id'];
                    }
                    if ($loops == $count) break;
                }
            }
        }

        $view = '
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Won Tickets</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <ul class="products-list product-list-in-box">';
        foreach ($tickets as $ticket) {
            $tic = $this->Util_model->get_info("ticket","*","WHERE id=$ticket");
            $games = $this->Util_model->row_count("games","WHERE ticketID=$ticket");
            $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($tic['baseID'],'base_main')."' alt='@".$this->Base_model->get_base_info($tic['baseID'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($tic['baseID'])."/ticket/$ticket' class='product-title'>".$this->Util_model->get_info("stacks","name","WHERE id=$tic[stackID]")." <i class='fa fa-arrow-left'></i>
                                <span class='label label-success pull-right' data-toggle='tooltip' title='Total number of games in ticket'>$games games</span></a>
                            <span class='product-description'>
                          Posted $tic[date]
                        </span>
                        </div>
                    </li>";
        }
        $view .= "</ul>
            </div>
        </div>";
        return $view;
    }

    public function watchlist ($uid) {
        $s = $this->Db_model->selectGroup("ref","stat","WHERE `by`=$uid AND ref_xtra='ticket' AND type='watch'");
        $view = "";
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $ticket = $this->Util_model->get_info("ticket","*","WHERE id=$row[ref]");
                $view .= $this->Base_model->view_ticket($ticket);
                /*if (count($ticks) == $page_total) {
                    break;
                }*/
            }
        } else {
            $view = "<div class='well'><p>You don't have any ticket in your watchlist</p></div>";
        }

        return $view;
    }

    public function bases () {
        $view = "";
        if ($this->session->has_userdata(UID)) {
            $s = $this->Db_model->selectGroup("*","base_main","WHERE uid=".$this->session->userdata(UID));
            $view = "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            My Bases
                        </h4>
                        <button class='btn btn-primary btn-xs btn-flat pull-right' type='button' onclick='dialog(\"".base_url()."ajax/own-base\",\"create=new\",\"gen-modal\",\"sm\")'>Own a Base</button>
                    </div>
                    <div class='box-body'>
                    ";
            if ($s->num_rows() > 0) {
                $view .= '<ul class="products-list product-list-in-box">';
                foreach ($s->result_array() as $row) {
                    $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($row['id'],'base_main')."' alt='@".$this->Base_model->get_base_info($row['id'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($row['id'])."' class='product-title'>".$this->Base_model->get_base_info($row['id'],'Name')."
                                <span class='label label-info  pull-right pointer-cursor' data-toggle='tooltip' title='Followers today'>".count_format($this->Util_model->row_count("base_followers","WHERE baseID=$row[id] AND date LIKE '".date_time('d')."%'"))." followers today</span></a>
                            <span class='product-description'>
                              @".$this->Base_model->get_base_info($row['id'],'username')." - ".$this->Base_model->get_base_percentage($row['id'])."% success rating
                            </span>
                        </div>
                    </li>";
                }
                $view .= '</ul>';
            }
            $view .= "</div>
                </div>";

            $s = $this->Db_model->selectGroup("*","base_followers","WHERE follower=".$this->session->userdata(UID));
            $view .= "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            My Followed Bases
                        </h4>
                    </div>
                    <div class='box-body'>
                    ";
            if ($s->num_rows() > 0) {
                $view .= '<ul class="products-list product-list-in-box">';
                foreach ($s->result_array() as $row) {
                    $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($row['baseID'],'base_main')."' alt='@".$this->Base_model->get_base_info($row['baseID'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($row['baseID'])."' class='product-title'>".$this->Base_model->get_base_info($row['baseID'],'Name')."</a>
                                <span class='label label-success  pull-right pointer-cursor' data-toggle='tooltip' title='Unfollow this base' onclick='follow_unfollow(\"".base_url()."\",\"".$this->session->userdata(UID)."\",\"$row[baseID]\",\"unfollow\",\"list\",$(this),\"base\")'>unfollow</span>
                            <span class='product-description'>
                              @".$this->Base_model->get_base_info($row['baseID'],'username')." - ".$this->Base_model->get_base_percentage($row['id'])."% success rating
                            </span>
                        </div>
                    </li>";
                }
                $view .= '</ul>';
            } else {
                $view .= "<div class='well'><p>You are not following any base. You won't see much tickets.</p></div>";
            }
            $view .= '</div>
                </div>';
        }

        $view .= "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            Suggested Bases
                        </h4>
                    </div>
                    <div class='box-body'>
                    ";
        $view .= '<ul class="products-list product-list-in-box">';
        foreach ($this->get_suggested_base($this->session->userdata(UID), 24,32) as $id) {
            $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($id,'base_main')."' alt='@".$this->Base_model->get_base_info($id,'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($id)."' class='product-title'>".$this->Base_model->get_base_info($id,'Name')."</a>
                                <span class='label label-danger  pull-right pointer-cursor' data-toggle='tooltip' title='Follow this base' onclick='follow_unfollow(\"".base_url()."\",\"".$this->session->userdata(UID)."\",\"$id\",\"follow\",\"list\",$(this),\"base\")'>follow</span>
                            <span class='product-description'>
                              @".$this->Base_model->get_base_info($id,'username')." - ".$this->Base_model->get_base_percentage($id)."% success rating
                            </span>
                        </div>
                    </li>";
        }
        $view .= '</ul>
                </div>
            </div>';
        return $view;
    }

    public function stacks () {
        $view = "";
        if ($this->session->has_userdata(UID)) {
            $s = $this->Db_model->selectGroup("id","base_main","WHERE uid=".$this->session->userdata(UID));
            $view = "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            My Stacks
                        </h4>
                    </div>
                    <div class='box-body'>
                    ";
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    $ss = $this->Db_model->selectGroup("*","stacks","WHERE baseID=$row[id]");
                    $view .= '<ul class="products-list product-list-in-box">';
                    foreach ($ss->result_array() as $stack) {
                        $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($stack['baseID'],'base_main')."' alt='@".$this->Base_model->get_base_info($stack['baseID'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($stack['baseID'])."/stack/$stack[id]' class='product-title'>".$this->Base_model->get_base_info($row['id'],'Name')." - $stack[name]
                                <span class='label label-info  pull-right pointer-cursor' data-toggle='tooltip' title='Active subscribers'>".count_format($this->Util_model->row_count("user_subscription","WHERE stackID=$stack[id] AND subStatus=1"))." active subscribers</span></a>
                            <span class='product-description'>
                                ".$this->Base_model->get_stack_percentage($stack['id'])."% success rating
                            </span>
                        </div>
                    </li>";
                    }

                }
                $view .= '</ul>';
            }
            $view .= "</div>
                </div>";

            $s = $this->Db_model->selectGroup("stackID","user_subscription","WHERE uid=".$this->session->userdata(UID));
            $view .= "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            Subscribed Stacks
                        </h4>
                    </div>
                    <div class='box-body'>
                    ";
            if ($s->num_rows() > 0) {
                $view .= '<ul class="products-list product-list-in-box">';
                foreach ($s->result_array() as $sub) {
                    $row = $this->Util_model->get_info("stacks","*","WHERE id=$sub[stackID]");
                    $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($row['baseID'],'base_main')."' alt='@".$this->Base_model->get_base_info($row['baseID'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($row['baseID'])."/stack/$row[id]' class='product-title'>".$this->Base_model->get_base_info($row['baseID'],'Name')." - $row[name]</a>
                                <span class='label label-success  pull-right pointer-cursor' data-toggle='tooltip' title='You are currently subscribe on this stack'>subscribed</span>
                            <span class='product-description'>
                                ".$this->Base_model->get_stack_percentage($row['id'])."% success rating
                            </span>
                        </div>
                    </li>";
                }
                $view .= '</ul>';
            } else {
                $view .= "<div class='well'><p>You are not subscribed to any stack.</p></div>";
            }
            $view .= '</div>
                </div>';
        }

        $view .= "
                <div class='box box-default'>
                    <div class='box-header'>
                        <h4 class='box-title'>
                            Suggested Stacks
                        </h4>
                    </div>
                    <div class='box-body'>
                    ";
        $view .= '<ul class="products-list product-list-in-box">';
        foreach ($this->get_suggested_stacks($this->session->userdata(UID), 24,32) as $id) {
            $row = $this->Util_model->get_info("stacks","*","WHERE id=$id");
            $view .= "<li class='item'>
                        <div class='product-img'>
                            <img src='".base_url().$this->Util_model->picture($row['baseID'],'base_main')."' alt='@".$this->Base_model->get_base_info($row['baseID'],'username')."'>
                        </div>
                        <div class='product-info'>
                            <a href='".$this->Base_model->get_base_url($row['baseID'])."/stack/$row[id]' class='product-title'>".$this->Base_model->get_base_info($row['baseID'],'Name')." - $row[name]</a>
                                <a href='".$this->Base_model->get_base_url($row['baseID'])."/user-subscribe/$row[id]'><span class='label label-danger  pull-right pointer-cursor' data-toggle='tooltip' title='Subscribe to this stack'>subscribe</span></a>
                            <span class='product-description'>
                                ".$this->Base_model->get_stack_percentage($row['id'])."% success rating
                            </span>
                        </div>
                    </li>";
        }
        $view .= '</ul>
                </div>
            </div>';
        return $view;
    }

    public function fixtures () {
        $count = 0;
        $view = "<div class='box box-default'>
            <div class='box-header'>
                <h4 class='box-title'>Top Fixtures</h4>
                <a href='".base_url()."livescore' class='btn btn-primary btn-xs btn-flat pull-right'><i class='fa fa-soccer-ball-o'></i> Livescore</a>
            </div>
            <div class='box-body'>
            ";
        $top = $this->Db_model->selectGroup("countryID, leagueID, name","sports_league","WHERE top=1");
        foreach ($top->result_array() as $league) {
            $country = $this->Util_model->get_info("sports_country","name","WHERE countryID=$league[countryID]");
            $s = $this->Db_model->selectGroup("matchID", "sports_fixture", "WHERE leagueID=$league[leagueID] AND date='".date_time('d')."'");
            if ($s->num_rows() > 0) {
                $count++;
                $view .= "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bottom-1x' style='border-bottom: thin solid #bdc3c7'>
                    <h5 style='border-bottom: thin solid #bdc3c7' class='text-bold'>$country - $league[name]</h5>";
                foreach ($s->result_array() as $row) {
                    $view .= $this->list_fixtures_attach($this->Util_model->get_info("sports_fixture","*","WHERE matchID=$row[matchID]"));
                }
                $view .= "</div>";
            }
        }
        if ($count == 0) $view .= "<div class='well'>View <a href='".base_url()."livescore'>livescore</a></div>";
        $view .= "</div>
            </div>";

        return $view;
    }

    public function list_home_tickets ($async=false) {
        $view = "";
        $bases = array();
        $ticketIDs = array();
        $ser = "";
        $new_tickets = array();
        $all_tickets = array();
        if ($this->session->has_userdata('ticketIDs')) {
            $ticketIDs = $this->session->userdata('ticketIDs');
        }
        if ($this->session->has_userdata(UID)) {
            $my_fbases = $this->Db_model->selectGroup("baseID","base_followers","WHERE follower=".$this->session->userdata(UID));
            if ($my_fbases->num_rows() > 0) {
                foreach ($my_fbases->result_array() as $f_bases) {
                    $ser .= "baseID=$f_bases[baseID] OR ";
                } // Getting the base ID of the followed bases
            }
            
            if (!$async) {
                if ($this->Util_model->row_count("base_followers","WHERE follower=".$this->session->userdata(UID)) < 10) {
                    $view .= "<div class='callout callout-info'><i class='fa fa-info-circle'></i> Follow more base to see more tickets. <a href='".base_url()."home/bases#bases'>View suggested bases</a> </div>";
                } // Checking if the user is following up 10 bases
            }

            $my_bases = $this->Db_model->selectGroup("id","base_main","WHERE uid=".$this->session->userdata(UID));
            if ($my_bases->num_rows() > 0) {
                foreach ($my_bases->result_array() as $base) {
                    $ser .= "baseID=$base[id] OR ";
                } // Get my base IDs

                $ser = rtrim($ser, " OR ")." AND";
            } 
            
        }

        $count = 0;
        $today = date_time('d');

        $tickets = $this->Db_model->selectGroup("id", "ticket", "WHERE $ser date NOT LIKE '$today%' ORDER BY RAND()");
        if ($tickets->num_rows() > 0) {
            foreach ($tickets->result_array() as $ticket) {
                if (!in_array($ticket['id'],$ticketIDs)) {
                    $new_tickets[] = $ticket['id'];
                    $count++;
                }
                if ($count == 4) break;
            } // Get tickets from yesterday backward IDs
        }


        $tickets = $this->Db_model->selectGroup("id", "ticket", "WHERE date LIKE '$today%' ORDER BY RAND()");
        if ($tickets->num_rows() > 0) {
            foreach ($tickets->result_array() as $ticket) {
                if (!in_array($ticket['id'], $ticketIDs)) {
                    $new_tickets[] = $ticket['id'];
                    $count++;
                }
                if ($count == 3) break;
            } // Get today tickets
        }

        shuffle($new_tickets);

        $count = 0;
        for ($i=0; $i<count($new_tickets); $i++) {
           $all_tickets[] = $new_tickets[$i];
             if ($i==1 || $i==3 || $i==5) {
                 $s = $this->Db_model->selectGroup("ref","top_suggestions","WHERE type='ticket'");
                 if ($s->num_rows() > 0) {
                     foreach ($s->result_array() as $row) {
                         if (!in_array($row['ref'], $ticketIDs)) {
                             $all_tickets[] = $row['ref'];
                             break;
                         }
                     }
                 }
            }
        }

        foreach ($all_tickets as $ticket) {
            $view .= $this->Base_model->view_ticket($this->Util_model->get_info("ticket","*","WHERE id=$ticket"));
            $ticketIDs[] = $ticket;
        }
        $this->session->set_flashdata('ticketIDs', $ticketIDs);

        return $view;
    }
}
?>