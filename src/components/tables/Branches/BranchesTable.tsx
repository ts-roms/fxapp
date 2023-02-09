import React, { useEffect, useState, useCallback } from 'react';
import { Space, TablePaginationConfig } from 'antd';
import {
  BasicTableRow,
  getBranchesData,
  BranchesTableRow,
  Pagination,
} from 'api/table.api';
import { Table } from 'components/common/Table/Table';
import { ColumnsType } from 'antd/es/table';
import { Button } from 'components/common/buttons/Button/Button';
import { useTranslation } from 'react-i18next';
import { notificationController } from 'controllers/notificationController';
import { useMounted } from '@app/hooks/useMounted';

const initialPagination: Pagination = {
  current: 1,
  pageSize: 10,
};

export const BranchesTable: React.FC = () => {
  const [tableData, setTableData] = useState<{
    data: BranchesTableRow[];
    pagination: Pagination;
    loading: boolean;
  }>({
    data: [],
    pagination: initialPagination,
    loading: false,
  });
  const { t } = useTranslation();
  const { isMounted } = useMounted();

  const fetch = useCallback(
    (pagination: Pagination) => {
      setTableData((tableData) => ({ ...tableData, loading: true }));
      getBranchesData(pagination, initialPagination.pageSize!).then((res) => {
        if (isMounted.current) {
          setTableData({
            data: res.data,
            pagination: res.pagination,
            loading: false,
          });
        }
      });
    },
    [isMounted],
  );

  useEffect(() => {
    fetch(initialPagination);
  }, [fetch]);

  const handleTableChange = (pagination: TablePaginationConfig) => {
    fetch(pagination);
  };

  const handleDeleteRow = (rowId: number) => {
    setTableData({
      ...tableData,
      data: tableData.data.filter((item) => item.key !== rowId),
      pagination: {
        ...tableData.pagination,
        total: tableData.pagination.total
          ? tableData.pagination.total - 1
          : tableData.pagination.total,
      },
    });
  };

  const columns: ColumnsType<BasicTableRow> = [
    {
      title: 'Name',
      dataIndex: 'name',
    },
    {
      title: 'Note',
      dataIndex: 'note',
    },
    {
      title: 'Default',
      dataIndex: 'default',
      render: (isDefault: boolean) => <span>{isDefault ? 'Yes' : 'No'}</span>,
    },
    {
      title: t('tables.actions'),
      dataIndex: 'actions',
      width: '15%',
      render: (text: string, record: { name: string; key: number }) => {
        return (
          <Space>
            <Button
              type="ghost"
              onClick={() => {
                notificationController.info({
                  message: t('tables.inviteMessage', { name: record.name }),
                });
              }}
            >
              {t('tables.invite')}
            </Button>
            <Button
              type="default"
              danger
              onClick={() => handleDeleteRow(record.key)}
            >
              {t('tables.delete')}
            </Button>
          </Space>
        );
      },
    },
  ];

  return (
    <Table
      columns={columns}
      dataSource={tableData.data}
      pagination={tableData.pagination}
      loading={tableData.loading}
      onChange={handleTableChange}
      scroll={{ x: 800 }}
      bordered
    />
  );
};
