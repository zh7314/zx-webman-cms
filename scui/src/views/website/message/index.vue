<template>
	<el-container>
		<el-header>
			<div class="left-panel">
				<el-button type="primary" icon="el-icon-plus" @click="add">增加</el-button>
			</div>
			<div class="right-panel">
				<div class="right-panel-search">
					<el-input v-model="search.real_name" placeholder="联系人" clearable></el-input>
					<el-input v-model="search.mobile" placeholder="联系方式" clearable></el-input>
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
				<el-table-column label="标题" prop="title" show-overflow-tooltip
								 min-width="100"></el-table-column>
				<el-table-column label="联系人" prop="real_name" width="150"></el-table-column>
				<el-table-column label="联系方式" prop="mobile" width="150"></el-table-column>
				<el-table-column label="处理意见" prop="remark" show-overflow-tooltip
								 min-width="100"></el-table-column>
				<el-table-column label="处理状态" prop="is_show" width="150">
					<template #default="scope">
						<el-tag v-if="scope.row.status==10" type="success">待处理</el-tag>
						<el-tag v-if="scope.row.status==20" type="danger">已处理</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="邮件是否发送" prop="is_sent" width="150">
					<template #default="scope">
						<el-tag v-if="scope.row.is_sent==10" type="success">待发送</el-tag>
						<el-tag v-if="scope.row.is_sent==100" type="danger">发送成功</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="邮件" prop="email" width="150"></el-table-column>
				<el-table-column label="反馈内容	" prop="content" show-overflow-tooltip
								 min-width="100"></el-table-column>
				<el-table-column label="请求IP" prop="ip" width="150"></el-table-column>
				<el-table-column label="创建时间" prop="create_at" width="150"></el-table-column>
				<el-table-column label="操作" fixed="right" align="center" width="200">
					<template #default="scope">
						<el-button-group>
							<el-button text type="primary" size="small" @click="edit(scope.row, scope.$index)">
								详情
							</el-button>
							<el-button text type="primary" size="small" @click="deal(scope.row, scope.$index)">
								处理
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

	<deal-dialog v-if="dialog.deal" ref="dealDialog" @success="handleSaveSuccess"
				 @closed="dialog.deal=false"></deal-dialog>

</template>

<script>
import addDialog from './add'
import saveDialog from './save'
import dealDialog from './deal'

export default {
	name: 'admin',
	components: {
		addDialog,
		saveDialog,
		dealDialog
	},
	data() {
		return {
			dialog: {
				add: false,
				save: false,
				deal: false,
			},
			apiObj: this.$API.website.message.list,
			selection: [],
			search: {}
		}
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
		//处理
		deal(row) {
			this.dialog.deal = true
			this.$nextTick(() => {
				this.$refs.dealDialog.open().setData(row)
			})
		},
		//删除
		async del(row) {
			var reqData = {id: row.id}
			var res = await this.$API.website.message.delete.post(reqData)

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
