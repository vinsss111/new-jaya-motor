<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
        // Detect TiDB Cloud by env hints or hostname patterns
        $isTiDBEnv = false;
        if (getenv('TIDB_CLOUD') || getenv('TIDB_HOST') || getenv('TIDB_PORT')) {
            $isTiDBEnv = true;
        }

        if ($databaseUrl) {
            $parts = parse_url($databaseUrl);
            if ($parts !== false) {
                if (!empty($parts['host'])) {
                    $this->default['hostname'] = $parts['host'];
                }
                if (!empty($parts['user'])) {
                    $this->default['username'] = $parts['user'];
                }
                if (array_key_exists('pass', $parts)) {
                    $this->default['password'] = $parts['pass'];
                }
                if (!empty($parts['path'])) {
                    $db = ltrim($parts['path'], '/');
                    if ($db !== '') {
                        $this->default['database'] = $db;
                    }
                }

                // If host suggests TiDB (e.g., contains 'tidb'), mark as TiDB
                if (!empty($parts['host']) && stripos($parts['host'], 'tidb') !== false) {
                    $isTiDBEnv = true;
                }

                // If TiDB detected, enforce port 4000. Otherwise prefer port in URL if present.
                if ($isTiDBEnv) {
                    $this->default['port'] = 4000;
                } elseif (!empty($parts['port'])) {
                    $this->default['port'] = (int) $parts['port'];
                }
            }
        } else {
            $envPort = getenv('DATABASE_DEFAULT_DBPORT');
            if ($envPort !== false && $envPort !== '') {
                $this->default['port'] = (int) trim($envPort);
            } else {
                // If user indicates TiDB via env, enforce 4000, else use MySQL default 3306
                $this->default['port'] = $isTiDBEnv ? 4000 : 3306;
            }
        }
            $this->default['hostname'] = trim(getenv('DATABASE_DEFAULT_HOSTNAME'));
        }
        if (getenv('DATABASE_DEFAULT_USERNAME')) {
            $this->default['username'] = trim(getenv('DATABASE_DEFAULT_USERNAME'));
        }
        if (getenv('DATABASE_DEFAULT_PASSWORD')) {
            $this->default['password'] = trim(getenv('DATABASE_DEFAULT_PASSWORD'));
        }
        if (getenv('DATABASE_DEFAULT_DATABASE')) {
            $this->default['database'] = trim(getenv('DATABASE_DEFAULT_DATABASE'));
        }
        if (getenv('DATABASE_DEFAULT_DBDRIVER')) {
            $this->default['DBDriver'] = trim(getenv('DATABASE_DEFAULT_DBDRIVER'));
        }
        
        // Allow common single DATABASE_URL style env vars used by hosts (Railway, ClearDB, JawsDB, etc.)
        $databaseUrl = getenv('DATABASE_URL') ?: getenv('CLEARDB_DATABASE_URL') ?: getenv('JAWSDB_URL') ?: getenv('MYSQL_URL') ?: getenv('MYSQL_DATABASE_URL');

        if ($databaseUrl) {
            $parts = parse_url($databaseUrl);
            if ($parts !== false) {
                if (!empty($parts['host'])) {
                    $this->default['hostname'] = $parts['host'];
                }
                if (!empty($parts['user'])) {
                    $this->default['username'] = $parts['user'];
                }
                if (array_key_exists('pass', $parts)) {
                    $this->default['password'] = $parts['pass'];
                }
                if (!empty($parts['path'])) {
                    $db = ltrim($parts['path'], '/');
                    if ($db !== '') {
                        $this->default['database'] = $db;
                    }
                }
                if (!empty($parts['port'])) {
                    $this->default['port'] = (int) $parts['port'];
                }
            }
        } else {
            $envPort = getenv('DATABASE_DEFAULT_DBPORT');
            if ($envPort !== false && $envPort !== '') {
                $this->default['port'] = (int) trim($envPort);
            } else {
                $this->default['port'] = 4000; // Default port for TiDB Cloud, override if needed
            }
        }
    }

    //    /**
    //     * Sample database connection for SQLite3.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'database'    => 'database.db',
    //        'DBDriver'    => 'SQLite3',
    //        'DBPrefix'    => '',
    //        'DBDebug'     => true,
    //        'swapPre'     => '',
    //        'failover'    => [],
    //        'foreignKeys' => true,
    //        'busyTimeout' => 1000,
    //        'synchronous' => null,
    //        'dateFormat'  => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for Postgre.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'public',
    //        'DBDriver'   => 'Postgre',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'port'       => 5432,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for SQLSRV.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'dbo',
    //        'DBDriver'   => 'SQLSRV',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'encrypt'    => false,
    //        'failover'   => [],
    //        'port'       => 1433,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for OCI8.
    //     *
    //     * You may need the following environment variables:
    //     *   NLS_LANG                = 'AMERICAN_AMERICA.UTF8'
    //     *   NLS_DATE_FORMAT         = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_FORMAT    = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_TZ_FORMAT = 'YYYY-MM-DD HH24:MI:SS'
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => 'localhost:1521/FREEPDB1',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'DBDriver'   => 'OCI8',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'AL32UTF8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

}
