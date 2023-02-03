import React from 'react';
import {
  DashboardOutlined,
  UserSwitchOutlined,
  TransactionOutlined,
  FileSyncOutlined,
  FundOutlined,
  MoneyCollectOutlined,
  RiseOutlined,
  UserOutlined,
  AuditOutlined,
} from '@ant-design/icons';

export interface SidebarNavigationItem {
  title: string;
  key?: string;
  url?: string;
  children?: SidebarNavigationItem[];
  icon?: React.ReactNode;
  isDisabled?: true;
}

export const sidebarNavigation: SidebarNavigationItem[] = [
  {
    title: 'common.medical-dashboard',
    key: 'medical-dashboard',
    url: '/',
    icon: <DashboardOutlined />,
  },
  {
    title: 'common.transactions',
    key: 'transactions',
    url: '/transactions',
    icon: <TransactionOutlined />,
  },
  {
    title: 'Collections',
    key: 'collections',
    url: '/collections',
    icon: <FileSyncOutlined />,
  },
  {
    title: 'Funds',
    key: 'funds',
    url: '/funds',
    icon: <FundOutlined />,
  },
  {
    title: 'Expenses',
    key: 'expenses',
    url: '/expenses',
    icon: <MoneyCollectOutlined />,
  },
  {
    title: 'Other Income',
    key: 'other-income',
    url: '/other-income',
    icon: <RiseOutlined />,
  },
  {
    title: 'Big Brother',
    key: 'big-brother',
    url: '/big-brother',
    icon: <UserOutlined />,
  },
  {
    title: 'Reports',
    key: 'reports',
    url: '/reports',
    icon: <AuditOutlined />,
  },
  {
    title: 'Configurations',
    key: 'configuration',
  },
  {
    title: 'Employees',
    key: 'configuration-employees',
    icon: <UserSwitchOutlined />,
    children: [
      {
        title: 'Loans',
        key: 'feed',
        url: '/configuration/feed',
      },
      {
        title: 'common.kanban',
        key: 'kanban',
        url: '/configuration/kanban',
      },
    ],
  },
  {
    title: 'Accounting',
    key: 'configuration-accounting',
    icon: <AuditOutlined />,
    children: [
      {
        title: 'Loans',
        key: 'accounting-report',
        url: '/configuration/loans',
      },
      {
        title: 'common.kanban',
        key: 'accounting-charts',
        url: '/configuration/kanban',
      },
    ],
  },
  {
    title: 'Expenses',
    key: 'configuration-expenses',
    url: '/configuration/expenses',
    icon: <AuditOutlined />,
  },
  {
    title: 'Other Income',
    key: 'configuration-other-income',
    url: '/configuration/other-income',
    icon: <AuditOutlined />,
  },
  {
    title: 'Custom Fields',
    key: 'configuration-custom-fields',
    url: '/configuration/custom-fields',
    icon: <AuditOutlined />,
  },
  {
    title: 'Users',
    key: 'configuration-users',
    url: '/configuration/users',
    icon: <AuditOutlined />,
  },
  {
    title: 'Audit Trail',
    key: 'audit-trail',
    url: '/audit-trail',
    icon: <AuditOutlined />,
  },
];
