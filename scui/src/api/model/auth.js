import config from "@/config"
import http from "@/utils/request"

export default {
	login: {
		url: `${config.API_URL}/api/admin/login`,
		name: "登录获取TOKEN",
		post: async function (data = {}) {
			return await http.post(this.url, data);
		}
	},
	menu: {
		getMenu: {
			url: `${config.API_URL}/api/admin/getMenu`,
			name: "获取我的菜单",
			post: async function () {
				return await http.post(this.url);
			}
		}
	},
	ver: {
		url: `${config.API_URL}/api/admin/getVersion`,
		name: "获取最新版本号",
		post: async function (params) {
			return await http.post(this.url, params);
		}
	},
}
