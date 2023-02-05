import React, { useEffect, useState, useCallback } from 'react';
import { Space, TablePaginationConfig } from 'antd';
import {
  BasicTableRow,
  getTransactionData,
  Pagination,
  TransactionTableRow,
} from 'api/table.api';
import { Table } from 'components/common/Table/Table';
import { ColumnsType } from 'antd/es/table';
import { Button } from 'components/common/buttons/Button/Button';
import { useTranslation } from 'react-i18next';
import { notificationController } from 'controllers/notificationController';
import { Status } from '@app/components/profile/profileCard/profileFormNav/nav/payments/paymentHistory/Status/Status';
import { useMounted } from '@app/hooks/useMounted';

const initialPagination: Pagination = {
  current: 1,
  pageSize: 10,
};

export const TransactionTable: React.FC = () => {
  const [tableData, setTableData] = useState<{
    data: TransactionTableRow[];
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
      getTransactionData(pagination, initialPagination.pageSize!).then((res) => {
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
      title: 'Reference',
      dataIndex: 'reference',
      render: (reference: string) => <Button type="link">{reference}</Button>,
    },
    {
      title: t('common.name'),
      dataIndex: 'employee',
      render: (text: string) => <span>{text}</span>,
      filterMode: 'tree',
      filterSearch: true,
      filters: [
        {
          text: t('common.firstName'),
          value: 'firstName',
          children: [
            {
              text: 'Joe',
              value: 'Joe',
            },
            {
              text: 'Pavel',
              value: 'Pavel',
            },
            {
              text: 'Jim',
              value: 'Jim',
            },
            {
              text: 'Josh',
              value: 'Josh',
            },
          ],
        },
        {
          text: t('common.lastName'),
          value: 'lastName',
          children: [
            {
              text: 'Green',
              value: 'Green',
            },
            {
              text: 'Black',
              value: 'Black',
            },
            {
              text: 'Brown',
              value: 'Brown',
            },
          ],
        },
      ],
      onFilter: (value: string | number | boolean, record: BasicTableRow) =>
        record.name.includes(value.toString()),
    },
    {
      title: 'Principal',
      dataIndex: 'principal',
      render: (text: string) => <span>P {Number(text).toFixed(2)}</span>,
    },
    {
      title: 'Balance',
      dataIndex: 'balance',
      render: (text: string) => <span>P {Number(text).toFixed(2)}</span>,
    },
    {
      title: 'Disbursed Date',
      dataIndex: 'disbursedDate',
      render: (disbursedDate: string) => <span>{disbursedDate}</span>,
    },
    {
      title: 'Disbursed By',
      dataIndex: 'disbursedBy',
      render: (disbursedBy: string) => <span>{disbursedBy}</span>,
    },
    {
      title: 'Loan Type',
      dataIndex: 'loanType',
      render: (text: string) => <span>{text}</span>,
    },
    {
      title: 'Status',
      dataIndex: 'status',
      render: (status: string) => (
        <span>
          <Status text={status} color="" />
        </span>
      ),
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
