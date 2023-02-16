import React, { useState } from 'react';
import { PlusOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import * as S from './ChartsOfAccount.styles';
import { useTranslation } from 'react-i18next';
import { ChartsOfAccountTable } from '@app/components/tables/Configuration/Accounting/ChartsOfAccountTable';
import ChartsOfAccountModal from '@app/components/modals/modal/ChartsOfAccountModal';

export const ChartsOfAccount: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);

  return (
    <S.MainWrapper>
      <ChartsOfAccountModal open={open} setOpen={setOpen} />
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Charts of Account' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Charts of Account' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <ChartsOfAccountTable />
      </S.Card>
    </S.MainWrapper>
  );
};
