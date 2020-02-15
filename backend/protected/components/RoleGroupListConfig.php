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

}