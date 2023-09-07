function loadComponent(component) {
	if (component) {
		return () => import(/* webpackChunkName: "[request]" */ `@/views/${component}`)
	} else {
		return () => import(`@/layout/other/empty`)
	}
}

export default function formatRoutes(routerMap) {
	const accessedRouters = []
	routerMap.forEach(item => {
		item.meta = item.meta ? item.meta : {};
		//处理外部链接特殊路由
		if (item.meta.type == 'iframe') {
			item.meta.url = item.path;
			item.path = `/i/${item.name}`;
		}
		//MAP转路由对象
		var route = {
			path: item.url,
			name: item.url,
			meta: item.meta,
			redirect: item.redirect ?? '',
			children: item.children ? formatRoutes(item.children) : null,
			component: loadComponent(item.url)
		}
		accessedRouters.push(route)
	})

	// 将404页面添加到最后面
	accessedRouters.push({path: '*', redirect: '/404', hidden: true})
	return accessedRouters


	// routes.forEach(route => {
	//   const router = {
	//     meta: {}
	//   }
	//   const {
	//     parent_permission_id,
	//     permission_name,
	//     permission_url,
	//     redirect,
	//     component,
	//     keep_alive,
	//     small_icon_name,
	//     name,
	//     children,
	//     hidden
	//   } = route
	//   if (component === 'Layout') {
	//     router['component'] = Layout
	//   } else {
	//     router['component'] = loadView(component)
	//   }
	//   if (redirect !== null) {
	//     router['redirect'] = redirect
	//   }
	//   if (small_icon_name !== null) {
	//     router['meta']['icon'] = small_icon_name
	//   }
	//   if (children && children instanceof Array && children.length > 0) {
	//     router['children'] = formatRoutes(children)
	//   }
	//   if (name !== null) {
	//     router['name'] = name
	//   }
	//   router['meta']['title'] = permission_name
	//   router['path'] = permission_url
	//   if (parent_permission_id === 0) {
	//     router['alwaysShow'] = true
	//   }
	//   router['meta']['noCache'] = !keep_alive
	//   if (hidden === 10) {
	//     router['hidden'] = false
	//   } else {
	//     router['hidden'] = true
	//   }
	//   formatRoutesArr.push(router)
	// })
	// // 将404页面添加到最后面
	// formatRoutesArr.push({ path: '*', redirect: '/404', hidden: true })
	// return formatRoutesArr
}
