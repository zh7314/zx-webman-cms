import config from "@/config"
import http from "@/utils/request"

export default {
	banner: {
		list: {
			url: `${config.API_URL}/api/admin/banner/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/banner/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/banner/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/banner/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	bannerCate: {
		list: {
			url: `${config.API_URL}/api/admin/bannerCate/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/bannerCate/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/bannerCate/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/bannerCate/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getTree: {
			url: `${config.API_URL}/api/admin/getBannerCateTree`,
			name: "分组树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	lang: {
		list: {
			url: `${config.API_URL}/api/admin/lang/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/lang/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/lang/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/lang/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	platform: {
		list: {
			url: `${config.API_URL}/api/admin/platform/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/platform/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/platform/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/platform/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	download: {
		list: {
			url: `${config.API_URL}/api/admin/download/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/download/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/download/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/download/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	downloadCate: {
		list: {
			url: `${config.API_URL}/api/admin/downloadCate/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/downloadCate/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/downloadCate/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/downloadCate/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getTree: {
			url: `${config.API_URL}/api/admin/getDownloadCateTree`,
			name: "分组树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	news: {
		list: {
			url: `${config.API_URL}/api/admin/news/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/news/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/news/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/news/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	newsCate: {
		list: {
			url: `${config.API_URL}/api/admin/newsCate/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/newsCate/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/newsCate/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/newsCate/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getTree: {
			url: `${config.API_URL}/api/admin/getNewsCateTree`,
			name: "分组树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	product: {
		list: {
			url: `${config.API_URL}/api/admin/product/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/product/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/product/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/product/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	productCate: {
		list: {
			url: `${config.API_URL}/api/admin/productCate/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/productCate/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/productCate/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/productCate/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getTree: {
			url: `${config.API_URL}/api/admin/getProductCateTree`,
			name: "树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	video: {
		list: {
			url: `${config.API_URL}/api/admin/video/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/video/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/video/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/video/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	videoCate: {
		list: {
			url: `${config.API_URL}/api/admin/videoCate/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/videoCate/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/videoCate/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/videoCate/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		getTree: {
			url: `${config.API_URL}/api/admin/getVideoCateTree`,
			name: "分组树菜单",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
	},
	feedback: {
		list: {
			url: `${config.API_URL}/api/admin/feedback/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/feedback/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/feedback/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/feedback/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	friendLink: {
		list: {
			url: `${config.API_URL}/api/admin/friendLink/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/friendLink/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/friendLink/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/friendLink/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	jobOffers: {
		list: {
			url: `${config.API_URL}/api/admin/jobOffers/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/jobOffers/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/jobOffers/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/jobOffers/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	seo: {
		list: {
			url: `${config.API_URL}/api/admin/seo/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/seo/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/seo/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/seo/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
	message: {
		list: {
			url: `${config.API_URL}/api/admin/message/getList`,
			name: "列表",
			get: async function (params) {
				return await http.post(this.url, params);
			}
		},
		add: {
			url: `${config.API_URL}/api/admin/message/add`,
			name: "增加",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		save: {
			url: `${config.API_URL}/api/admin/message/save`,
			name: "保存",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		},
		delete: {
			url: `${config.API_URL}/api/admin/message/delete`,
			name: "删除",
			post: async function (params) {
				return await http.post(this.url, params);
			}
		}
	},
}
