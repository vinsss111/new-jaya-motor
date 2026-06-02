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
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    public function __construct()
    {
        parent::__construct();

        // Detect TiDB Cloud via env or hostname patterns
        $isTiDBEnv = false;
        if (getenv('TIDB_CLOUD') || getenv('TIDB_HOST') || getenv('TIDB_PORT')) {
            $isTiDBEnv = true;
        }

        // Try to parse DATABASE_URL-style env vars first (Railway, ClearDB, JawsDB, etc.)
        $databaseUrl = getenv('DATABASE_URL') 
            ?: (getenv('CLEARDB_DATABASE_URL') 
            ?: (getenv('JAWSDB_URL') 
            ?: (getenv('MYSQL_URL') 
            ?: (getenv('MYSQL_DATABASE_URL') 
            ?: false))));

        if ($databaseUrl) {
            $parts = parse_url($databaseUrl);
            if ($parts !== false) {
                if (!empty($parts['host'])) {
                    $this->default['hostname'] = $parts['host'];
                    // If host contains 'tidb', mark as TiDB
                    if (stripos($parts['host'], 'tidb') !== false) {
                        $isTiDBEnv = true;
                    }
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
                // If TiDB detected, enforce port 4000. Otherwise prefer port in URL if present.
                if ($isTiDBEnv) {
                    $this->default['port'] = 4000;
                } elseif (!empty($parts['port'])) {
                    $this->default['port'] = (int) $parts['port'];
                }
            }
        } else {
            // Fall back to individual DATABASE_DEFAULT_* env vars
            if ($envHost = getenv('DATABASE_DEFAULT_HOSTNAME')) {
                $this->default['hostname'] = trim($envHost);
            }
            if ($envUser = getenv('DATABASE_DEFAULT_USERNAME')) {
                $this->default['username'] = trim($envUser);
            }
            if ($envPass = getenv('DATABASE_DEFAULT_PASSWORD')) {
                $this->default['password'] = trim($envPass);
            }
            if ($envDb = getenv('DATABASE_DEFAULT_DATABASE')) {
                $this->default['database'] = trim($envDb);
            }
            if ($envDriver = getenv('DATABASE_DEFAULT_DBDRIVER')) {
                $this->default['DBDriver'] = trim($envDriver);
            }

            // Handle port: TiDB must use 4000, else use provided or default 3306
            $envPort = getenv('DATABASE_DEFAULT_DBPORT');
            if ($isTiDBEnv) {
                $this->default['port'] = 4000;
            } elseif ($envPort !== false && $envPort !== '') {
                $this->default['port'] = (int) trim($envPort);
            } else {
                $this->default['port'] = 3306;
            }
        }

        // AMAN UNTUK TiDB: Lewati pengecekan sertifikat SSL lokal di container Docker
        $this->default['encrypt'] = [
            'ssl_verify_server_cert' => false
        ];
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
        'port'        => 4000,
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
