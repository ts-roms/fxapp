import React, { useEffect, useState, useCallback } from 'react';
import { Avatar, Image, Space, TablePaginationConfig } from 'antd';
import { BasicTableRow, Pagination } from 'api/table.api';
import { Table } from 'components/common/Table/Table';
import { ColumnsType } from 'antd/es/table';
import { Button } from 'components/common/buttons/Button/Button';
import { useTranslation } from 'react-i18next';
import { notificationController } from 'controllers/notificationController';
import { Status } from '@app/components/profile/profileCard/profileFormNav/nav/payments/paymentHistory/Status/Status';
import { useMounted } from '@app/hooks/useMounted';
import { getEmployees } from '@app/api/employee.api';
import { capitalize } from '@app/utils/utils';

const initialPagination: Pagination = {
  current: 1,
  pageSize: 10,
};

export const LoanTable: React.FC = () => {
  const [tableData, setTableData] = useState<{
    data: BasicTableRow[];
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
      getEmployees(pagination, initialPagination.pageSize!).then((res) => {
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
      title: 'Image',
      dataIndex: 'photo',
      render: (image: any) => (
        <Avatar
          size={{ xs: 24, sm: 32, md: 40, lg: 64, xl: 80, xxl: 100 }}
          icon={<Image src={image} alt={'text'} />}
        />
      ),
    },
    {
      title: t('common.name'),
      dataIndex: 'name',
      render: (_: string, row: any) => (
        <span>{`${capitalize(row.lastName)}, ${capitalize(
          row.firstName,
        )} ${capitalize(row.middleName)}`}</span>
      ),
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
      title: 'Contact #',
      dataIndex: 'age',
      sorter: (a: BasicTableRow, b: BasicTableRow) => a.age - b.age,
      showSorterTooltip: false,
    },
    {
      title: t('common.address'),
      dataIndex: 'address',
    },
    {
      title: 'Branch',
      dataIndex: 'branch',
    },
    {
      title: 'Status',
      dataIndex: 'active',
      render: (status: string) => (
        <span>
          {status}
          <Status text={'status'} color="#EREREE" />
        </span>
      ),
      filterMode: 'tree',
      filterSearch: true,
      filters: [
        {
          text: 'Status',
          value: 'status',
          children: [
            {
              text: 'Active',
              value: 'Active',
            },
            {
              text: 'Pending',
              value: 'Pending',
            },
          ],
        },
      ],
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
              Block
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
