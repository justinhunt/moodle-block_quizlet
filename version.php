<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2014122301;               
$plugin->requires  = 2010031900;      // Requires this Moodle version
$plugin->cron      = 0;               // Period for cron to check this module (secs)
$plugin->component = 'block_quizletquiz'; // To check on upgrade, that module sits in correct place
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '1.0.0 (Build 2014092903)';
