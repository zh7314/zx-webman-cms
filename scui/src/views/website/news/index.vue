<template>
	<el-container>
		<el-header>
			<div class="left-panel">
				<el-button type="primary" icon="el-icon-plus" @click="add">增加</el-button>
			</div>
			<div class="right-panel">
				<div class="right-panel-search">
					<el-cascader v-model="search.news_cate_id" :options="options" :props="props"
								 :show-all-levels="false"
								 clearable style="width: 100%;" placeholder="选择类型"></el-cascader>
					<el-input v-model="search.title" placeholder="标题" clearable></el-input>
					<el-button type="primary" icon="el-icon-search" @click="upsearch">搜索</el-button>
				</div>
			</div>
		</el-header>
		<el-main class="nopadding">
			<scTable ref="table" :apiObj="apiObj" row-key="id" border stripe>
				<!--				<el-table-column type="selection" width="40"></el-table-column>-->
				<el-table-column label="id" prop="id" width="70"></el-table-column>
				<el-table-column label="平台类型" prop="platform" width="90"></el-table-column>
				<el-table-column label="语言类型" prop="lang" width="90"></el-table-column>
				<el-table-column label="所属分类" prop="news_cate.name" width="100"></el-table-column>
				<el-table-column label="标题" prop="title" show-overflow-tooltip
								 min-width="300"></el-table-column>
				<el-table-column label="短标题" prop="short_title" show-overflow-tooltip
								 min-width="300"></el-table-column>
				<el-table-column label="图片" prop="pic" width="100">
					<template #default="scope">
						<el-popover>
							<template #reference>
								<el-avatar :src="scope.row.pic" shape="square"/>
							</template>
							<template #default>
								<el-image style="width: 100%; height: 100%" :src="scope.row.pic"/>
							</template>
						</el-popover>
					</template>
				</el-table-column>
				<el-table-column label="浏览数" prop="count" width="150"></el-table-column>
				<el-table-column label="是否显示" prop="is_show" width="150">
					<template #default="scope">
						<el-tag v-if="scope.row.is_show==10" type="success">是</el-tag>
						<el-tag v-if="scope.row.is_show==20" type="danger">否</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="排序" prop="sort"></el-table-column>
				<el-table-column label="创建时间" prop="create_at" width="150"></el-table-column>
				<el-table-column label="操作" fixed="right" align="center" width="150">
					<template #default="scope">
						<el-button-group>
							<el-button text type="primary" size="small" @click="edit(scope.row, scope.$index)">
								编辑
							</el-button>
							<el-popconfirm title="确定删除吗？" @confirm="del(scope.row, scope.$index)">
								<template #reference>
									<el-button text type="danger" size="small">删除</el-button>
								</template>
							</el-popconfirm>
						</el-button-group>
					</template>
				</el-table-column>
			</scTable>
		</el-main>
	</el-container>

	<add-dialog v-if="dialog.add" ref="addDialog" @success="handleSaveSuccess"
				@closed="dialog.add=false"></add-dialog>

	<save-dialog v-if="dialog.save" ref="saveDialog" @success="handleSaveSuccess"
				 @closed="dialog.save=false"></save-dialog>

</template>

<script>

import addDialog from './add'
import saveDialog from './save'

export default {
	name: 'admin',
	components: {
		addDialog,
		saveDialog
	},
	data() {
		return {
			dialog: {
				add: false,
				save: false
			},
			apiObj: this.$API.website.news.list,
			selection: [],
			search: {},
			//所需数据选项
			options: [],
			props: {
				value: "id",
				emitPath: false,
				checkStrictly: true,
				label: "name"
			}
		}
	},
	mounted() {
		this.getNewsCate()
	},
	methods: {
		//添加
		add() {
			this.dialog.add = true
			this.$nextTick(() => {
				this.$refs.addDialog.open()
			})
		},
		//编辑
		edit(row) {
			this.dialog.save = true
			this.$nextTick(() => {
				this.$refs.saveDialog.open().setData(row)
			})
		},
		//加载树数据
		async getNewsCate() {
			var res = await this.$API.website.newsCate.getTree.get();
			this.options = res.data ?? [];
			// this.options.unshift(this.topOptions)
		},
		//删除
		async del(row) {
			var reqData = {id: row.id}
			var res = await this.$API.website.news.delete.post(reqData)

			if (res.code == 200) {
				this.$refs.table.refresh()
				this.$message.success("删除成功")
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}
		},
		//搜索
		upsearch() {
			this.$refs.table.upData(this.search)
		},
		//本地更新数据
		handleSaveSuccess() {
			this.$refs.table.refresh()
		}
	}
}
</script>

<style>
</style>
