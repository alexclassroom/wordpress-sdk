<?php
	/**
	 * @package     Freemius
	 * @copyright   Copyright (c) 2015, Freemius, Inc.
	 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
	 * @since       1.0.3
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	class FS_Affiliate extends FS_Scope_Entity {
        /**
         * @var number
         */
        public $custom_affiliate_terms_id;
        /**
         * @var boolean
         */
        public $is_using_custom_terms;
        /**
         * @var string status Enum: `pending`, `rejected`, `suspended`, or `active`. Defaults to `pending`.
         */
        public $status;

        /**
         * @author Leo Fajardo
         * @since 1.2.1.7.2
         *
         * @return bool
         */
        function is_active() {
            return ( 'active' === $this->status );
        }

        /**
         * @author Leo Fajardo
         * @since 1.2.1.7.2
         *
         * @return bool
         */
        function is_pending() {
            return ( 'pending' === $this->status );
        }

        /**
         * @author Leo Fajardo
         * @since 1.2.1.7.2
         *
         * @return bool
         */
        function is_suspended() {
            return ( 'suspended' === $this->status );
        }

        /**
         * @author Leo Fajardo
         * @since 1.2.1.7.2
         *
         * @return bool
         */
        function is_rejected() {
            return ( 'rejected' === $this->status );
        }
	}