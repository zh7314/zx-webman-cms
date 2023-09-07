<template>
	<el-container>
		<el-header>
			<div class="left-panel">
				<el-button type="primary" icon="el-icon-plus" @click="add">增加</el-button>
				<!--				<el-button type="danger" plain icon="el-icon-delete" :disabled="selection.length==0" @click="batch_del"></el-button>-->
			</div>
			<div class="right-panel">
				<div class="right-panel-search">
					<!--					<el-input v-model="search.name" placeholder="分组名称" clearable></el-input>-->
					<!--					<el-button type="primary" icon="el-icon-search" @click="upsearch">搜索</el-button>-->
				</div>
			</div>
		</el-header>
		<el-main class="nopadding">
			<scTable ref="table" :apiObj="apiObj" row-key="id" @selection-change="selectionChange" hidePagination>
				<!--				<el-table-column type="selection" width="50"></el-table-column>-->
				<el-table-column label="id" prop="id" width="120"></el-table-column>
				<el-table-column label="控制名称" prop="name" width="150"></el-table-column>
				<el-table-column label="控制器URL" prop="path" show-overflow-tooltip min-width="300"></el-table-column>
				<el-table-column label="前台页面" prop="component" show-overflow-tooltip min-width="300"></el-table-column>
				<el-table-column label="是否是菜单" prop="is_menu" width="100">
					<template #default="scope">
						<el-tag v-if="scope.row.is_menu==10" type="success">是</el-tag>
						<el-tag v-if="scope.row.is_menu==20" type="danger">否</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="icon" prop="icon" min-width="100">
					<template #default="scope">
						<el-button text :icon=scope.row.icon>
						</el-button>
					</template>
				</el-table-column>
				<el-table-column label="排序" prop="sort" min-width="50"></el-table-column>
				<el-table-column label="是否隐藏" prop="hidden" width="100">
					<template #default="scope">
						<el-tag v-if="scope.row.hidden==10" type="success">显示</el-tag>
						<el-tag v-if="scope.row.hidden==20" type="danger">不显示</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="创建时间" prop="create_at" width="180"></el-table-column>
				<el-table-column label="操作" fixed="right" align="center" width="170">
					<template #default="scope">
						<el-button-group>
							<el-button text type="primary" size="small" @click="edit(scope.row, scope.$index)">
								编辑
							</el-button>
							<el-popconfirm title="确定删除吗？" @confirm="del(scope.row, scope.$index)">
								<template #reference>
									<el-button text type="primary" size="small">删除</el-button>
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
	name: 'group',
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
			apiObj: this.$API.system.adminPermission.getMenuTree,
			selection: [],
			search: {
				name: null
			}
		}
	},
	methods: {
		statusStyle(Status) {
			return Status
		},
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
		//删除
		async del(row) {
			var reqData = {id: row.id}
			var res = await this.$API.system.adminPermission.delete.post(reqData);
			if (res.code == 200) {
				this.$refs.table.refresh()
				this.$message.success("删除成功")
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}
		},
		//表格选择后回调事件
		selectionChange(selection) {
			this.selection = selection;
		},
		//搜索
		// upsearch() {
		// 	this.$refs.table.upData(this.search)
		// },
		//本地更新数据
		handleSaveSuccess() {
			this.$refs.table.refresh()
		}
	}
}
</script>

<style>
</style>
