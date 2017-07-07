<?php
// $Id: createdirfailed_exception.php 1990 2009-01-08 18:16:11Z dualface $

/**
 * 定义 Q_CreateDirFailedException 异常
 *
 * @link http://qeephp.com/
 * @copyright Copyright (c) 2006-2009 Qeeyuan Inc. {@link http://www.qeeyuan.com}
 * @license New BSD License {@link http://qeephp.com/license/}
 * @version $Id: createdirfailed_exception.php 1990 2009-01-08 18:16:11Z dualface $
 * @package exception
 */

/**
 * Q_CreateDirFailedException 异常封装指示创建目录失败
 *
 * @author YuLei Liao <liaoyulei@qeeyuan.com>
 * @version $Id: createdirfailed_exception.php 1990 2009-01-08 18:16:11Z dualface $
 * @package exception
 */
class Q_CreateDirFailedException extends QException
{
    public $dir;

    function __construct($dir)
    {
        $this->dir = $dir;
        parent::__construct(__('Create dir "%s" failed.', $dir));
    }
}

