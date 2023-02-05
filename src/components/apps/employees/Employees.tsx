import React, { useState } from 'react';
import { DownloadOutlined, PlusOutlined } from '@ant-design/icons';
import StepFormModal from '@app/shared/Modal/StepFormModal';
import { Button } from 'antd';
import { useTranslation } from 'react-i18next';
import * as S from './Emloyees.styles';
import { EmployeeTable } from '@app/components/tables/Employees/EmployeeTable';

export const Employees: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);

  return (
    <S.MainWrapper>
      <StepFormModal open={open} setOpen={setOpen} />
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Employees' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<DownloadOutlined />}
              style={{
                marginRight: 10,
              }}
            >
              Import
            </Button>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Employee' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <EmployeeTable />
      </S.Card>
    </S.MainWrapper>
  );
};
