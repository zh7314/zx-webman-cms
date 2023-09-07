import config from "@/config"
import http from "@/utils/request"

export default {
	admin: {
		list: {
			url: `${config.API_URL}/api/admin/admin/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/admin/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/admin/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getOne: {
			url: `${config.API_URL}/api/admin/admin/getOne`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/admin/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		changePwd: {
			url: `${config.API_URL}/api/admin/changePwd`,
			name: "修改密码",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	adminGroup: {
		list: {
			url: `${config.API_URL}/api/admin/adminGroup/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/adminGroup/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/adminGroup/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/adminGroup/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getGroupTree: {
			url: `${config.API_URL}/api/admin/getGroupTree`,
			name: "分组树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	adminPermission: {
		list: {
			url: `${config.API_URL}/api/admin/adminPermission/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/adminPermission/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/adminPermission/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/adminPermission/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getMenuTree: {
			url: `${config.API_URL}/api/admin/getMenuTree`,
			name: "树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	adminLog: {
		list: {
			url: `${config.API_URL}/api/admin/adminLog/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/adminLog/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/adminLog/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/adminLog/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	apiLog: {
		list: {
			url: `${config.API_URL}/api/admin/requestLog/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/requestLog/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/requestLog/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/requestLog/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	dic: {
		tree: {
			url: `${config.API_URL}/system/dic/tree`,
			name: "获取字典树",
			get: async function () {
				return await http.get(this.url);
			}
		},
		list: {
			url: `${config.API_URL}/system/dic/list`,
			name: "字典明细",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		},
		get: {
			url: `${config.API_URL}/system/dic/get`,
			name: "获取字典数据",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	role: {
		list: {
			url: `${config.API_URL}/system/role/list2`,
			name: "获取角色列表",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	dept: {
		list: {
			url: `${config.API_URL}/system/dept/list`,
			name: "获取部门列表",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	user: {
		list: {
			url: `${config.API_URL}/system/user/list`,
			name: "获取用户列表",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	app: {
		list: {
			url: `${config.API_URL}/system/app/list`,
			name: "应用列表",
			get: async function () {
				return await http.get(this.url);
			}
		}
	},
	log: {
		list: {
			url: `${config.API_URL}/system/log/list`,
			name: "日志列表",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	table: {
		list: {
			url: `${config.API_URL}/system/table/list`,
			name: "表格列管理列表",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		},
		info: {
			url: `${config.API_URL}/system/table/info`,
			name: "表格列管理详情",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	},
	tasks: {
		list: {
			url: `${config.API_URL}/system/tasks/list`,
			name: "系统任务管理",
			get: async function (params) {
				return await http.get(this.url, params);
			}
		}
	}
}
