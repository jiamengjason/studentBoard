<?php
/**
 * 用户角色分组
 */

class RoleGroupListConfig
{
    //机构角色ID
    public static $organizationRoleId = 1;

    //教师角色ID
    public static $teacherRoleId = 2;

    //学生角色ID
    public static $studentRoleId = 3;

    //家长角色ID
    public static $parentRoleId = 4;


    /**
     * 获取所有角色ID列表
     * @return array
     */
	public static function getRoleIdList(){
	    return [
	        self::$organizationRoleId => '机构',
            self::$teacherRoleId => '教师',
            self::$studentRoleId => '学生',
            self::$parentRoleId => '家长'
        ];
    }


    /**
     * 获取在读学校下的年级列表
     * @return array
     */
    public static function getGradeList(){
        return [
            1 => '一年级',
            2 => '二年级',
            3 => '三年级',
            4 => '四年级',
            5 => '五年级',
            6 => '六年级',
            7 => '初一',
            8 => '初二',
            9 => '初三',
            10 => '高一',
            11 => '高二',
            12 => '高三',
            13 => '大学一年级',
            14 => '大学二年级',
            15 => '大学三年级',
            16 => '大学四年级',
        ];
    }

    /**
     * 教师/机构评价得分
     * @return array
     */
    public static function getScoreList(){
        return [
            1,
            2,
            3,
            4,
            5
        ];
    }

    /**
     * 标签列表
     * @return array
     */
    public static function getTagsList(){
        return [
            '认真负责',
            '谦虚',
            '可爱',
            '教学质量过硬',
            '讲的细心',
        ];
    }
}